<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DrugPrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert into drug_prescriptions table
        DB::table('drug_prescriptions')->insert([
            [
                'medical_record_id' => 1,
                'patient_id' => 1,
                'stock' => 'in_stock',
                'dosage_instructions' => json_encode([
                    [
                        'drug_id' => 1,
                        'dosage_instructions' => 'Take one pill after breakfast'
                    ],
                    [
                        'drug_id' => 2,
                        'dosage_instructions' => 'Apply ointment twice daily'
                    ]
                ]),
                'prescription_date' => Carbon::now(),
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            // Add more entries as needed
        ]);

        // Insert into drug_prescription_drug table
        DB::table('drug_prescription_drug')->insert([
            [
                'drug_prescription_id' => 1,
                'drug_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'drug_prescription_id' => 1,
                'drug_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more entries as needed
        ]);
    }
}
