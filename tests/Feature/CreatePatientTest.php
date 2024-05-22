<?php

use App\Models\User;
use App\Models\Patient;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a patient', function () {
    // Authenticate using Sanctum
    Sanctum::actingAs(User::factory()->create(), ['*']);

    $patientData = [
        'file_number' => '123456',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'gender' => 'male',
        'date_of_birth' => '1990-01-01',
        'phone_number' => '1234567890',
        'next_of_kin_name' => 'Jane Doe',
        'next_of_kin_relationship' => 'sister',
        'next_of_kin_phone_number' => '0987654321',
    ];

    $response = $this->postJson('/api/patients', $patientData);

    $response->assertStatus(201);
    $this->assertDatabaseHas('patients', $patientData);
});
