<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    private $patientData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->patientData = [
            'file_number' => '12345',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 'male',
            'date_of_birth' => '1980-01-01',
            'phone_number' => '1234567890',
            'next_of_kin_name' => 'Jane Doe',
            'next_of_kin_relationship' => 'Sister',
            'next_of_kin_phone_number' => '0987654321',
        ];
    }

    public function test_can_create_a_patient()
    {
        $response = $this->postJson('/api/patients', $this->patientData);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Patient created successfully']);
    }

    public function test_can_read_a_patient()
    {
        $patient = Patient::create($this->patientData);

        $response = $this->getJson("/api/patients/{$patient->id}");

        $response->assertStatus(200)
                 ->assertJson(['data' => $this->patientData]);
    }

    public function test_can_update_a_patient()
    {
        $patient = Patient::create($this->patientData);
        $updateData = ['first_name' => 'Jane'];

        $response = $this->putJson("/api/patients/{$patient->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Patient updated successfully']);
    }

    public function test_can_delete_a_patient()
    {
        $patient = Patient::create($this->patientData);

        $response = $this->deleteJson("/api/patients/{$patient->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Patient deleted successfully']);
    }

    public function test_can_reactivate_a_deleted_patient()
    {
        $patient = Patient::create($this->patientData);
        $patient->delete();

        $response = $this->postJson("/api/patients/{$patient->id}/reactivate");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Patient reactivated successfully']);
    }

    public function test_validates_patient_data()
    {
        $invalidData = array_merge($this->patientData, ['phone_number' => 'invalid']);

        $response = $this->postJson('/api/patients', $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['phone_number']);
    }
}
