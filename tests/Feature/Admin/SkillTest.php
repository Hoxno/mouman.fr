<?php

namespace Tests\Feature\Admin;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
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
