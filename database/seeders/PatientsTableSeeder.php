<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 10 sample patients
        for ($i = 0; $i < 10; $i++) {
            DB::table('patients')->insert([
                'file_number' => $faker->unique()->ean8,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['male', 'female']),
                'date_of_birth' => $faker->date('Y-m-d', '-18 years'),
                'phone_number' => $faker->phoneNumber,
                'next_of_kin_name' => $faker->name,
                'next_of_kin_relationship' => $faker->randomElement(['Mother', 'Father', 'Sibling', 'Spouse']),
                'next_of_kin_phone_number' => $faker->phoneNumber,
                'status' => 'active',
                'created_by' => 1, // Assuming user with ID 1 exists
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
