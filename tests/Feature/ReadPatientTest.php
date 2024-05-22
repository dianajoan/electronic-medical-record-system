<?php

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can read a patient', function () {
    $patient = Patient::factory()->create();

    $response = $this->getJson("/api/patients/{$patient->id}");

    $response->assertStatus(200)
             ->assertJson($patient->toArray());
});
