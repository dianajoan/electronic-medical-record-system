<?php

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can reactivate a patient', function () {
    $patient = Patient::factory()->create(['deleted_at' => now()]);

    $response = $this->postJson("/api/patients/{$patient->id}/reactivate");

    $response->assertStatus(200);
    $this->assertDatabaseHas('patients', ['id' => $patient->id, 'deleted_at' => null]);
});
