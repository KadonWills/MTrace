<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_permissions = [
            ['roleid' => 1, 'permissions_id' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25] ],
            ['roleid' => 2, 'permissions_id' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15] ] 
        ]; 

        foreach( $roles_permissions as $roles_permission ){
            foreach($roles_permission['permissions_id'] as $permission_id){
                DB::table('roles_permissions')->insert(['roleid' => $roles_permission['roleid'], 'permissionid' => $permission_id]); 
            }
        }
    }
}
