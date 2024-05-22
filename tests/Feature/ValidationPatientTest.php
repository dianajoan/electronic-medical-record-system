<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('validates patient registration', function () {
    $invalidData = [
        'name' => '',
        'email' => 'invalid-email',
        'date_of_birth' => 'not-a-date',
        'gender' => 'unknown',
        'phone' => 'not-a-phone-number',
    ];

    $response = $this->postJson('/api/patients', $invalidData);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['name', 'email', 'date_of_birth', 'gender', 'phone']);
});
