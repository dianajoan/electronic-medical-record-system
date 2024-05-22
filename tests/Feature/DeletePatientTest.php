<?php

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can delete a patient', function () {
    $patient = Patient::factory()->create();

    $response = $this->deleteJson("/api/patients/{$patient->id}");

    $response->assertStatus(200);
    $this->assertSoftDeleted('patients', ['id' => $patient->id]);
});
