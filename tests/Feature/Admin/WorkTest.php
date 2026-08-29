<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create();
});

function donneesWork(array $remplacements = []): array
{
    return array_merge([
        'title' => 'Developpeur web',
        'company' => 'Une societe',
        'city' => 'Paris',
        'start_date' => '2020-01-01',
        'end_date' => '2022-12-31',
        'description' => 'Une description suffisamment longue.',
    ], $remplacements);
}

it('refuse un visiteur non authentifie', function () {
    get('/dashboard/work')->assertRedirect('/login');
});

it('refuse un utilisateur dont l email n est pas verifie', function () {
    actingAs(User::factory()->unverified()->create())
        ->get('/dashboard/work')
        ->assertRedirect('/verify-email');
});

it('liste les experiences', function () {
    Work::factory()->create(['company' => 'SocieteListee']);

    actingAs($this->admin)
        ->get('/dashboard/work')
        ->assertOk()
        ->assertSee('SocieteListee');
});

it('cree une experience', function () {
    actingAs($this->admin)
        ->post('/dashboard/work', donneesWork())
        ->assertRedirect(route('dashboard.work.index'))
        ->assertSessionHas('success');

    expect(Work::where('company', 'Une societe')->exists())->toBeTrue();
});

it('exige les champs obligatoires', function () {
    actingAs($this->admin)
        ->post('/dashboard/work', [])
        ->assertSessionHasErrors(['title', 'company', 'city', 'start_date', 'description']);

    expect(Work::count())->toBe(0);
});

it('met a jour une experience', function () {
    $work = Work::factory()->create(['company' => 'Ancienne societe']);

    actingAs($this->admin)
        ->put(route('dashboard.work.update', $work), donneesWork(['company' => 'Nouvelle societe']))
        ->assertRedirect(route('dashboard.work.index'));

    expect($work->fresh()->company)->toBe('Nouvelle societe');
});

it('supprime une experience', function () {
    $work = Work::factory()->create();

    actingAs($this->admin)
        ->delete(route('dashboard.work.destroy', $work))
        ->assertRedirect(route('dashboard.work.index'));

    expect(Work::find($work->id))->toBeNull();
});

it('refuse une date de fin anterieure au debut', function () {
    actingAs($this->admin)
        ->post('/dashboard/work', donneesWork([
            'start_date' => '2024-01-01',
            'end_date' => '2023-01-01',
        ]))
        ->assertSessionHasErrors('end_date');

    expect(Work::count())->toBe(0);
});

it('refuse une date de fin egale au debut', function () {
    actingAs($this->admin)
        ->post('/dashboard/work', donneesWork([
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-01',
        ]))
        ->assertSessionHasErrors('end_date');

    expect(Work::count())->toBe(0);
});

it('accepte une experience en cours', function (?string $fin) {
    actingAs($this->admin)
        ->post('/dashboard/work', donneesWork([
            'start_date' => '2024-01-01',
            'end_date' => $fin,
        ]))
        ->assertSessionHasNoErrors();

    expect(Work::count())->toBe(1);
})->with([
    'sentinelle 1900-01-01' => '1900-01-01',
    'chaine vide' => '',
    'valeur nulle' => null,
]);

it('refuse une date de debut non valide', function () {
    actingAs($this->admin)
        ->post('/dashboard/work', donneesWork(['start_date' => 'pas-une-date']))
        ->assertSessionHasErrors('start_date');

    expect(Work::count())->toBe(0);
});

it('formate les dates du tableau en d/m/Y', function () {
    Work::factory()->create([
        'company' => 'SocieteFormat',
        'start_date' => '2021-06-01',
        'end_date' => '2023-09-05',
    ]);

    actingAs($this->admin)
        ->get('/dashboard/work')
        ->assertOk()
        ->assertSee('01/06/2021')
        ->assertSee('05/09/2023')
        ->assertDontSee('2021-06-01')
        ->assertDontSee('2023-09-05');
});

it('signale les experiences en cours dans le tableau', function (?string $fin) {
    Work::factory()->create([
        'company' => 'SocieteEnCours',
        'start_date' => '2024-01-01',
        'end_date' => $fin,
    ]);

    actingAs($this->admin)
        ->get('/dashboard/work')
        ->assertOk()
        ->assertSee('En cours')
        // La sentinelle ne doit jamais transparaitre dans l'interface.
        ->assertDontSee('01/01/1900')
        // Carbon::parse(null) renverrait la date du jour.
        ->assertDontSee(now()->format('d/m/Y'));
})->with([
    'valeur nulle' => null,
    'sentinelle' => '1900-01-01',
]);

it('ne laisse aucune directive blade non compilee dans le tableau', function () {
    Work::factory()->create(['end_date' => '2023-09-05']);
    Work::factory()->create(['end_date' => null]);

    $html = actingAs($this->admin)->get('/dashboard/work')->assertOk()->getContent();

    expect($html)
        ->not->toContain('@else')
        ->not->toContain('@endif');
});
