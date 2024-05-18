<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabTest;
use App\Models\MedicalRecord;
use App\Models\User;

class LabTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample medical record IDs (replace with your actual medical record IDs)
        $medicalRecordIds = MedicalRecord::pluck('id')->toArray();

        // Sample authenticated user IDs (replace with your actual user IDs)
        $userIds = User::pluck('id')->toArray();

        $labTests = [
            [
                'name' => 'Blood Test',
                'duration' => 3,
                'medical_record_id' => $medicalRecordIds[array_rand($medicalRecordIds)],
                'authenticated_by' => $userIds[array_rand($userIds)],
                'status' => 'active',
            ],
            [
                'name' => 'Urine Test',
                'duration' => 2,
                'medical_record_id' => $medicalRecordIds[array_rand($medicalRecordIds)],
                'authenticated_by' => $userIds[array_rand($userIds)],
                'status' => 'active',
            ],
            [
                'name' => 'X-ray',
                'duration' => 1,
                'medical_record_id' => $medicalRecordIds[array_rand($medicalRecordIds)],
                'authenticated_by' => $userIds[array_rand($userIds)],
                'status' => 'inactive',
            ],
            // Add more sample lab tests as needed
        ];

        // Insert data using Eloquent ORM
        foreach ($labTests as $labTest) {
            LabTest::create($labTest);
        }
    }
}
