<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database Seeders.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'user_id'=>'1',
                'name'=>'Admin',
                'role'=>'admin',
                'status'=>'active'
            ),
            array(
                'user_id'=>'2',
                'name'=>'User',
                'role'=>'user',
                'status'=>'active'
            ),
        );

        DB::table('user_roles')->insert($data);
    }
}
