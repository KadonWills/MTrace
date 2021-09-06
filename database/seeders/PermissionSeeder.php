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
            ['id' => 6, 'name' => 'create mining_sale', 'code' => 'create-mining_sale'], 
            ['id' => 7, 'name' => 'edit mining_sale', 'code' => 'edit-mining_sale'], 
            ['id' => 8, 'name' => 'delete mining_sale', 'code' => 'delete-mining_sale'], 
            ['id' => 9, 'name' => 'print mining_sale', 'code' => 'print-mining_sale'], 
            ['id' => 10, 'name' => 'search mining_sale', 'code' => 'search-mining_sale'], 
            ['id' => 11, 'name' => 'create mining_production', 'code' => 'create-mining_production'], 
            ['id' => 12, 'name' => 'edit mining_production', 'code' => 'edit-mining_production'], 
            ['id' => 13, 'name' => 'delete mining_production', 'code' => 'delete-mining_production'], 
            ['id' => 14, 'name' => 'print mining_production', 'code' => 'print-mining_production'], 
            ['id' => 15, 'name' => 'search mining_production', 'code' => 'search-mining_production'], 
            ['id' => 16, 'name' => 'create mining_user', 'code' => 'create-mining_user'], 
            ['id' => 17, 'name' => 'edit mining_user', 'code' => 'edit-mining_user'], 
            ['id' => 18, 'name' => 'delete mining_user', 'code' => 'delete-mining_user'], 
            ['id' => 19, 'name' => 'print mining_user', 'code' => 'print-mining_user'], 
            ['id' => 20, 'name' => 'search mining_user', 'code' => 'search-mining_user'], 
            ['id' => 21, 'name' => 'create-mining_log', 'code' => 'create-mining_log'], 
            ['id' => 22, 'name' => 'edit-mining_log', 'code' => 'edit-mining_log'], 
            ['id' => 23, 'name' => 'delete-mining_log', 'code' => 'delete-mining_log'], 
            ['id' => 24, 'name' => 'print-mining_log', 'code' => 'print-mining_log'], 
            ['id' => 25, 'name' => 'search-mining_log', 'code' => 'search-mining_log'] 
        ]; 

        foreach( $permissions as $permission ){
            DB::table('permissions')->insert($permission); 
        }
    }
}
