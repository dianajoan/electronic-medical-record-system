<?php

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can update a patient', function () {
    $patient = Patient::factory()->create();
    $updatedData = [
        'name' => 'Jane Doe',
        'email' => 'janedoe@example.com',
    ];

    $response = $this->putJson("/api/patients/{$patient->id}", $updatedData);

    $response->assertStatus(200);
    $this->assertDatabaseHas('patients', $updatedData);
});
