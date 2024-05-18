<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database Seeders.
     *
     * @return void
     */
    public function run()
    {
        // Create sample users
        $faker = Faker::create();

        // Create admin user
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('2222'), // Hashed password 'password'
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create regular user
        $userId = DB::table('users')->insertGetId([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1111'), // Hashed password 'password'
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create doctor
        $userId = DB::table('users')->insertGetId([
            'name' => 'Doctor',
            'email' => 'doctor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('3333'), // Hashed password 'password'
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create nurse
        $userId = DB::table('users')->insertGetId([
            'name' => 'Nurse',
            'email' => 'nurse@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1111'), // Hashed password 'password'
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create lab technician
        $userId = DB::table('users')->insertGetId([
            'name' => 'Lab Technician',
            'email' => 'labtec@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1111'), // Hashed password 'password'
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create password reset tokens for both users
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'admin@example.com',
                'token' => Hash::make('admin_token'), // Hashed token 'admin_token'
                'created_at' => now(),
            ],
            [
                'email' => 'user@example.com',
                'token' => Hash::make('user_token'), // Hashed token 'user_token'
                'created_at' => now(),
            ],
        ]);

        // Create sessions for both users
        DB::table('sessions')->insert([
            [
                'id' => 'session_admin_id', // Unique session ID
                'user_id' => $adminId,
                'ip_address' => $faker->ipv4,
                'user_agent' => $faker->userAgent,
                'payload' => '',
                'last_activity' => time(),
            ],
            [
                'id' => 'session_user_id', // Unique session ID
                'user_id' => $userId,
                'ip_address' => $faker->ipv4,
                'user_agent' => $faker->userAgent,
                'payload' => '',
                'last_activity' => time(),
            ],
        ]);
    }
}
