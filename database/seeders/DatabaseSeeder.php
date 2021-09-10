<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class, 
            PermissionSeeder::class,
            UserRoleSeeder::class, 
            RolePermissionSeeder::class,
            ZoneSeeder::class
        ]); 
    }
}
