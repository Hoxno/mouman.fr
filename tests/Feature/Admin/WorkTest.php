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
