<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('has a home page', function () {
    get('/')->assertOk();
});
