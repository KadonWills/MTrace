<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'firstname' => 'MELI', 
                'lastname' => 'LANDRY',
                'email' => 'lnjohn@gmail.com',
                'username' => 'lnjohn',
                'password' => Hash::make('Admin@2021') 
            ],
            [
                'id' => 2, 
                'firstname' => Str::random(10), 
                'lastname' => Str::random(10), 
                'email' => Str::random(10)."@gmail.com", 
                'username' => 'aminier',
                'password' => 'password'
            ]
        ]; 
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
