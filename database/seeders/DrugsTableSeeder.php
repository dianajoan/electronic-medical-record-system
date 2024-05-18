<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drugs')->insert([
            [
                'name' => 'Paracetamol',
                'brand_name' => 'Panadol',
                'form' => 'Tablet',
                'code' => 'PARA001',
                'status' => 'active',
                'created_by' => 1, // Assuming user with ID 1 exists
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ibuprofen',
                'brand_name' => 'Advil',
                'form' => 'Tablet',
                'code' => 'IBUP001',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amoxicillin',
                'brand_name' => 'Amoxil',
                'form' => 'Capsule',
                'code' => 'AMOX001',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
