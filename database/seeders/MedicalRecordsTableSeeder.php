<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use App\Models\Diagnosis;


class MedicalRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have at least one patient and user
        $patients = Patient::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        
        // Assuming you have some diagnoses
        $diagnoses = Diagnosis::pluck('id')->toArray();
        
        // Sample medical records data
        $medicalRecords = [
            [
                'patient_id' => $patients[0],
                'user_id' => $users[0],
                'visit_date' => now()->subDays(10),
                'primary_diagnosis_id' => $diagnoses[0],
                'symptoms' => 'High fever, headache, and cough',
                'treatment_given' => 'Prescribed antibiotics and rest',
                'outcome' => 'discharged',
                'status' => 'active',
                'created_by' => $users[0], // Replace with an existing user id
                'updated_by' => $users[0], // Replace with an existing user id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'patient_id' => $patients[1],
                'user_id' => $users[1],
                'visit_date' => now()->subDays(15),
                'primary_diagnosis_id' => $diagnoses[1],
                'symptoms' => 'High fever, body ache, and fatigue',
                'treatment_given' => 'Prescribed antiviral medication and fluids',
                'outcome' => 'discharged',
                'status' => 'active',
                'created_by' => $users[1], // Replace with an existing user id
                'updated_by' => $users[1], // Replace with an existing user id
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more medical records as needed
        ];

        // Insert medical records into the database
        foreach ($medicalRecords as $record) {
            $medicalRecord = MedicalRecord::create($record);
            
            // Assuming you want to link some secondary diagnoses
            if ($medicalRecord->id == 1) {
                $medicalRecord->secondaryDiagnoses()->attach([$diagnoses[1], $diagnoses[2]]);
            } elseif ($medicalRecord->id == 2) {
                $medicalRecord->secondaryDiagnoses()->attach([$diagnoses[0], $diagnoses[2]]);
            }
        }
    }
}
