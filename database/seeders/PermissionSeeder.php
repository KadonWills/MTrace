<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 1, 'name' => 'create mining_zone', 'code' => 'create-mining_zone'], 
            ['id' => 2, 'name' => 'edit mining_zone', 'code' => 'edit-mining_zone'], 
            ['id' => 3, 'name' => 'delete mining_zone', 'code' => 'delete-mining_zone'], 
            ['id' => 4, 'name' => 'print mining_zone', 'code' => 'print-mining_zone'], 
            ['id' => 5, 'name' => 'search mining_zone', 'code' => 'search-mining_zone'], 
            ['id' => 6, 'name' => 'list mining_zone', 'code' => 'list-mining_zone'], 
            ['id' => 7, 'name' => 'create mining_sale', 'code' => 'create-mining_sale'], 
            ['id' => 8, 'name' => 'edit mining_sale', 'code' => 'edit-mining_sale'], 
            ['id' => 9, 'name' => 'delete mining_sale', 'code' => 'delete-mining_sale'], 
            ['id' => 10, 'name' => 'print mining_sale', 'code' => 'print-mining_sale'], 
            ['id' => 11, 'name' => 'search mining_sale', 'code' => 'search-mining_sale'], 
            ['id' => 12, 'name' => 'list mining_sale', 'code' => 'list-mining_sale'], 
            ['id' => 13, 'name' => 'create mining_production', 'code' => 'create-mining_production'], 
            ['id' => 14, 'name' => 'edit mining_production', 'code' => 'edit-mining_production'], 
            ['id' => 15, 'name' => 'delete mining_production', 'code' => 'delete-mining_production'], 
            ['id' => 16, 'name' => 'print mining_production', 'code' => 'print-mining_production'], 
            ['id' => 17, 'name' => 'search mining_production', 'code' => 'search-mining_production'], 
            ['id' => 18, 'name' => 'list mining_production', 'code' => 'list-mining_production'], 
            ['id' => 19, 'name' => 'create user', 'code' => 'create-user'], 
            ['id' => 20, 'name' => 'edit user', 'code' => 'edit-user'], 
            ['id' => 21, 'name' => 'delete user', 'code' => 'delete-user'], 
            ['id' => 22, 'name' => 'print user', 'code' => 'print-user'], 
            ['id' => 23, 'name' => 'search user', 'code' => 'search-user'], 
            ['id' => 24, 'name' => 'list user', 'code' => 'list-user'], 
            ['id' => 25, 'name' => 'create-mining_log', 'code' => 'create-mining_log'], 
            ['id' => 26, 'name' => 'edit-mining_log', 'code' => 'edit-mining_log'], 
            ['id' => 27, 'name' => 'delete-mining_log', 'code' => 'delete-mining_log'], 
            ['id' => 28, 'name' => 'print-mining_log', 'code' => 'print-mining_log'], 
            ['id' => 29, 'name' => 'search-mining_log', 'code' => 'search-mining_log'],
            ['id' => 30, 'name' => 'list-mining_log', 'code' => 'list-mining_log'] 
        ]; 

        foreach( $permissions as $permission ){
            DB::table('permissions')->insert($permission); 
        }
    }
}
