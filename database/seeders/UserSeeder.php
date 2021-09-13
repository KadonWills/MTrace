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
                'firstname' => 'ELOM',
                'lastname' => 'EMILE',
                'email' => 'constyemile@gmail.com',
                'username' => 'elmec',
                'password' => Hash::make('miningtrace')
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
