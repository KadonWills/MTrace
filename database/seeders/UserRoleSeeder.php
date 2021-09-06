<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_roles = [
            ['userid' => 1, 'roleid' => 1], 
            ['userid' => 2, 'roleid' => 2], 
        ]; 

        foreach ($users_roles as $users_role) {
            DB::table('users_roles')->insert($users_role); 
        }
    }
}
