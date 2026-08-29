<?php

namespace Tests\Feature\Admin;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create();
});

function donneesSchool(array $remplacements = []): array
{
    return array_merge([
        'title' => 'Master informatique',
        'school' => 'Une universite',
        'city' => 'Lyon',
        'start_date' => '2016-09-01',
        'end_date' => '2018-06-30',
        'description' => 'Une description suffisamment longue.',
    ], $remplacements);
}

it('refuse un visiteur non authentifie', function () {
    get('/dashboard/school')->assertRedirect('/login');
});

it('refuse un utilisateur dont l email n est pas verifie', function () {
    actingAs(User::factory()->unverified()->create())
        ->get('/dashboard/school')
        ->assertRedirect('/verify-email');
});

it('liste les formations', function () {
    School::factory()->create(['school' => 'EcoleListee']);

    actingAs($this->admin)
        ->get('/dashboard/school')
        ->assertOk()
        ->assertSee('EcoleListee');
});

it('cree une formation', function () {
    actingAs($this->admin)
        ->post('/dashboard/school', donneesSchool())
        ->assertRedirect(route('dashboard.school.index'))
        ->assertSessionHas('success');

    expect(School::where('school', 'Une universite')->exists())->toBeTrue();
});

it('exige les champs obligatoires', function () {
    actingAs($this->admin)
        ->post('/dashboard/school', [])
        ->assertSessionHasErrors(['title', 'school', 'city', 'start_date', 'description']);

    expect(School::count())->toBe(0);
});

it('met a jour une formation', function () {
    $school = School::factory()->create(['school' => 'Ancienne ecole']);

    actingAs($this->admin)
        ->put(route('dashboard.school.update', $school), donneesSchool(['school' => 'Nouvelle ecole']))
        ->assertRedirect(route('dashboard.school.index'));

    expect($school->fresh()->school)->toBe('Nouvelle ecole');
});

it('supprime une formation', function () {
    $school = School::factory()->create();

    actingAs($this->admin)
        ->delete(route('dashboard.school.destroy', $school))
        ->assertRedirect(route('dashboard.school.index'));

    expect(School::find($school->id))->toBeNull();
});

it('refuse une date de fin anterieure au debut', function () {
    actingAs($this->admin)
        ->post('/dashboard/school', donneesSchool([
            'start_date' => '2020-09-01',
            'end_date' => '2019-06-30',
        ]))
        ->assertSessionHasErrors('end_date');

    expect(School::count())->toBe(0);
});

it('accepte une formation en cours', function (?string $fin) {
    actingAs($this->admin)
        ->post('/dashboard/school', donneesSchool([
            'start_date' => '2020-09-01',
            'end_date' => $fin,
        ]))
        ->assertSessionHasNoErrors();

    expect(School::count())->toBe(1);
})->with([
    'sentinelle 1900-01-01' => '1900-01-01',
    'chaine vide' => '',
    'valeur nulle' => null,
]);
