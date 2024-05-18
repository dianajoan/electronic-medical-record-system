<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->truncate();

        Appointment::create([
            'name' => 'Initial Consultation',
            'clinical_notes' => 'Patient complains of severe headache.',
            'appointment_date' => '2024-05-20 10:00:00',
            'patient_id' => 1,
            'medical_record_id' => 1,
            'authenticated_by' => 1,
            'clinic_id' => 1,
            'status' => 'postponed',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Appointment::create([
            'name' => 'Follow-up',
            'clinical_notes' => 'Patient has shown improvement.',
            'appointment_date' => '2024-05-22 14:00:00',
            'patient_id' => 2,
            'medical_record_id' => 2,
            'authenticated_by' => 1,
            'clinic_id' => 1,
            'status' => 'postponed',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
