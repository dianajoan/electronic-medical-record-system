<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class LabTestOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate the table to start fresh
        DB::table('lab_test_orders')->truncate();

        // Sample data for seeding
        $labTestOrders = [
            [
                'medical_record_id' => 1,
                'ordered_by' => 1,
                'general_test_id' => 1,
                'test_name' => 'Complete Blood Count',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'medical_record_id' => 2,
                'ordered_by' => 2,
                'general_test_id' => 2,
                'test_name' => 'Liver Function Test',
                'status' => 'inactive',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            // Add more sample data as needed
        ];

        // Insert sample data
        DB::table('lab_test_orders')->insert($labTestOrders);

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
