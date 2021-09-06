<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'administrateur', 'code' => 'ADMIN'],
            ['id' => 2, 'name' => 'Artisan Minier', 'code' => 'AM'],
            ['id' => 3, 'name' => 'Artisan Collecteur', 'code' => 'AC'],
            ['id' => 4, 'name' => 'Bureau d\'Achat', 'code' => 'BA'],
            ['id' => 5, 'name' => 'Point Focal', 'code' => 'PF'],
            ['id' => 6, 'name' => 'Siège SNPPK', 'code' => 'SNPPK'],
        ];

        foreach($roles as $role){
            DB::table('roles')->insert($role); 
        }
    }
}
