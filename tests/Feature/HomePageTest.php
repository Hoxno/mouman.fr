<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\Skill;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('has a home page', function () {
    get('/')->assertOk();
});

it('ne transmet a la vue que les elements en ligne', function () {
    Skill::factory()->create(['title' => 'Competence en ligne']);
    Skill::factory()->offline()->create(['title' => 'Competence hors ligne']);
    Work::factory()->create(['company' => 'Societe en ligne']);
    Work::factory()->offline()->create(['company' => 'Societe hors ligne']);
    School::factory()->create(['school' => 'Ecole en ligne']);
    School::factory()->offline()->create(['school' => 'Ecole hors ligne']);

    $response = get('/')->assertOk();

    expect($response->viewData('skills')->pluck('title')->all())->toBe(['Competence en ligne']);
    expect($response->viewData('works')->pluck('company')->all())->toBe(['Societe en ligne']);
    expect($response->viewData('schools')->pluck('school')->all())->toBe(['Ecole en ligne']);
});

it('affiche les elements en ligne et masque les autres', function () {
    Skill::factory()->create(['title' => 'CompetenceVisible']);
    Skill::factory()->offline()->create(['title' => 'CompetenceCachee']);
    Work::factory()->create(['company' => 'SocieteVisible']);
    Work::factory()->offline()->create(['company' => 'SocieteCachee']);
    School::factory()->create(['school' => 'EcoleVisible']);
    School::factory()->offline()->create(['school' => 'EcoleCachee']);

    get('/')
        ->assertOk()
        ->assertSee('CompetenceVisible')
        ->assertSee('SocieteVisible')
        ->assertSee('EcoleVisible')
        ->assertDontSee('CompetenceCachee')
        ->assertDontSee('SocieteCachee')
        ->assertDontSee('EcoleCachee');
});

it('trie les competences par ordre croissant', function () {
    Skill::factory()->create(['title' => 'Troisieme', 'order' => '3']);
    Skill::factory()->create(['title' => 'Premier', 'order' => '1']);
    Skill::factory()->create(['title' => 'Deuxieme', 'order' => '2']);

    $skills = get('/')->assertOk()->viewData('skills');

    expect($skills->pluck('title')->all())->toBe(['Premier', 'Deuxieme', 'Troisieme']);
});

it('trie les experiences de la plus recente a la plus ancienne', function () {
    Work::factory()->create(['company' => 'Ancienne', 'start_date' => '2015-01-01']);
    Work::factory()->create(['company' => 'Recente', 'start_date' => '2024-01-01']);

    $works = get('/')->assertOk()->viewData('works');

    expect($works->pluck('company')->all())->toBe(['Recente', 'Ancienne']);
});

it('trie les formations de la plus recente a la plus ancienne', function () {
    School::factory()->create(['school' => 'Ancienne', 'start_date' => '2010-01-01']);
    School::factory()->create(['school' => 'Recente', 'start_date' => '2020-01-01']);

    $schools = get('/')->assertOk()->viewData('schools');

    expect($schools->pluck('school')->all())->toBe(['Recente', 'Ancienne']);
});

it('echappe le html contenu dans les descriptions', function () {
    Skill::factory()->create(['description' => "<script>alert('skill')</script>"]);
    Work::factory()->create(['description' => "<script>alert('work')</script>"]);
    School::factory()->create(['description' => "<script>alert('school')</script>"]);

    $html = get('/')->assertOk()->getContent();

    expect($html)
        ->not->toContain("<script>alert('skill')</script>")
        ->not->toContain("<script>alert('work')</script>")
        ->not->toContain("<script>alert('school')</script>")
        ->toContain('&lt;script&gt;');
});

it('affiche le titre des experiences terminees comme des experiences en cours', function (?string $fin) {
    Work::factory()->create([
        'title' => 'IntituleDuPoste',
        'start_date' => '2020-01-01',
        'end_date' => $fin,
    ]);

    get('/')->assertOk()->assertSee('IntituleDuPoste');
})->with([
    'terminee' => '2022-12-31',
    'en cours (null)' => null,
    'en cours (sentinelle)' => '1900-01-01',
]);

it('affiche le titre des formations terminees comme des formations en cours', function (?string $fin) {
    School::factory()->create([
        'title' => 'IntituleDuDiplome',
        'start_date' => '2016-09-01',
        'end_date' => $fin,
    ]);

    get('/')->assertOk()->assertSee('IntituleDuDiplome');
})->with([
    'terminee' => '2018-06-30',
    'en cours (null)' => null,
    'en cours (sentinelle)' => '1900-01-01',
]);

it('affiche la periode complete pour une experience terminee', function () {
    Work::factory()->create([
        'title' => 'PosteTermine',
        'start_date' => '2020-03-15',
        'end_date' => '2022-11-30',
    ]);

    get('/')
        ->assertOk()
        ->assertSee('15/03/2020')
        ->assertSee('30/11/2022')
        ->assertSee('PosteTermine');
});
