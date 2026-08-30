<?php

namespace Tests\Feature\Admin;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create();
});

it('refuse un visiteur non authentifie', function () {
    get('/dashboard/skill')->assertRedirect('/login');
});

it('refuse un utilisateur dont l email n est pas verifie', function () {
    actingAs(User::factory()->unverified()->create())
        ->get('/dashboard/skill')
        ->assertRedirect('/verify-email');
});

it('liste les competences', function () {
    $skill = Skill::factory()->create(['title' => 'Une competence']);

    actingAs($this->admin)
        ->get('/dashboard/skill')
        ->assertOk()
        ->assertSee('Une competence');
});

it('affiche le formulaire de creation', function () {
    actingAs($this->admin)->get('/dashboard/skill/create')->assertOk();
});

it('cree une competence', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', [
            'title' => 'PHP avance',
            'level' => '80',
            'order' => '1',
            'description' => 'Une description',
        ])
        ->assertRedirect(route('dashboard.skill.index'))
        ->assertSessionHas('success');

    expect(Skill::where('title', 'PHP avance')->exists())->toBeTrue();
});

it('refuse une competence sans titre', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['level' => '80', 'order' => '1'])
        ->assertSessionHasErrors('title');

    expect(Skill::count())->toBe(0);
});

it('refuse un titre de moins de trois caracteres', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['title' => 'ab', 'order' => '1'])
        ->assertSessionHasErrors('title');

    expect(Skill::count())->toBe(0);
});

it('met a jour une competence', function () {
    $skill = Skill::factory()->create(['title' => 'Ancien titre']);

    actingAs($this->admin)
        ->put(route('dashboard.skill.update', $skill), [
            'title' => 'Nouveau titre',
            'level' => '90',
            'order' => '2',
            'description' => 'Description mise a jour',
        ])
        ->assertRedirect(route('dashboard.skill.index'))
        ->assertSessionHas('success');

    expect($skill->fresh()->title)->toBe('Nouveau titre');
});

it('supprime une competence', function () {
    $skill = Skill::factory()->create();

    actingAs($this->admin)
        ->delete(route('dashboard.skill.destroy', $skill))
        ->assertRedirect(route('dashboard.skill.index'))
        ->assertSessionHas('success');

    expect(Skill::find($skill->id))->toBeNull();
});

it('n expose pas de route show', function () {
    $skill = Skill::factory()->create();

    // L'URI existe pour PUT/PATCH/DELETE : un GET y est refuse en 405.
    actingAs($this->admin)->get('/dashboard/skill/'.$skill->id)->assertMethodNotAllowed();
});

it('accepte un niveau aux bornes', function () {
    foreach (['0', '100', '70'] as $niveau) {
        actingAs($this->admin)
            ->post('/dashboard/skill', [
                'title' => 'Competence '.$niveau,
                'level' => $niveau,
                'order' => '1',
            ])
            ->assertSessionHasNoErrors();
    }

    expect(Skill::count())->toBe(3);
});

it('accepte un niveau absent', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['title' => 'Sans niveau', 'order' => '1'])
        ->assertSessionHasNoErrors();

    expect(Skill::where('title', 'Sans niveau')->exists())->toBeTrue();
});

it('refuse un niveau hors bornes', function (string $niveau) {
    actingAs($this->admin)
        ->post('/dashboard/skill', [
            'title' => 'Competence invalide',
            'level' => $niveau,
            'order' => '1',
        ])
        ->assertSessionHasErrors('level');

    expect(Skill::count())->toBe(0);
})->with(['101', '150', '-1', 'beaucoup', '7.5']);

it('exige un ordre, la colonne etant NOT NULL sans defaut', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['title' => 'Sans ordre', 'level' => '50'])
        ->assertSessionHasErrors('order');

    expect(Skill::count())->toBe(0);
});

it('accepte un ordre valide', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['title' => 'Avec ordre', 'order' => '0'])
        ->assertSessionHasNoErrors();

    expect(Skill::where('title', 'Avec ordre')->exists())->toBeTrue();
});

it('refuse un ordre invalide', function (string $ordre) {
    actingAs($this->admin)
        ->post('/dashboard/skill', ['title' => 'Ordre invalide', 'order' => $ordre])
        ->assertSessionHasErrors('order');

    expect(Skill::count())->toBe(0);
})->with(['-1', '2.5', 'premier']);

it('cree une competence publiee quand la case est cochee', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', [
            'title' => 'Publiee', 'order' => '1', 'online' => '1',
        ])
        ->assertSessionHasNoErrors();

    expect(Skill::where('title', 'Publiee')->first()->online)->toBe('1');
});

it('cree une competence masquee quand la case est decochee', function () {
    // Case decochee : seul le champ cache est transmis.
    actingAs($this->admin)
        ->post('/dashboard/skill', [
            'title' => 'Masquee', 'order' => '1', 'online' => '0',
        ])
        ->assertSessionHasNoErrors();

    expect(Skill::where('title', 'Masquee')->first()->online)->toBe('0');
});

it('permet de depublier une competence existante', function () {
    $skill = Skill::factory()->create(['title' => 'A depublier', 'online' => '1']);

    actingAs($this->admin)
        ->put(route('dashboard.skill.update', $skill), [
            'title' => 'A depublier', 'order' => '1', 'online' => '0',
        ])
        ->assertSessionHasNoErrors();

    expect($skill->fresh()->online)->toBe('0');
});

it('refuse une valeur de publication inattendue', function () {
    actingAs($this->admin)
        ->post('/dashboard/skill', [
            'title' => 'Valeur douteuse', 'order' => '1', 'online' => 'oui',
        ])
        ->assertSessionHasErrors('online');

    expect(Skill::count())->toBe(0);
});
