<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database Seeders.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('user_roles')->insert([
            [
                'name' => 'Administrator',
                'user_id' => 1, // Assuming user with ID 1 exists
                'role' => 'admin',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Regular User',
                'user_id' => 2, // Assuming user with ID 2 exists
                'role' => 'user',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Doctor',
                'user_id' => 3, // Assuming user with ID 3 exists
                'role' => 'doctor',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Nurse',
                'user_id' => 4, // Assuming user with ID 4 exists
                'role' => 'nurse',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Lab Technician',
                'user_id' => 5, // Assuming user with ID 5 exists
                'role' => 'lab_technician',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
