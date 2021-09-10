<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function users(){
        $permissions = UserController::getUserPermission(); 
        $roles = Role::all(); 
        return view('dashboard.users', compact('permissions', 'roles')); 
    }

    public function mining_zones(){
        $permissions = UserController::getUserPermission();
        $users = UserController::getUsersWithRole()
                        ->where('roles.code', '=', 'AM')
                        ->get()->toArray(); 
        $regions = ['CENTRE', 'OUEST', 'LITTORAL', 'SUD', 'NORD', 'EXTREME-NORD', 'ADAMAOUA', 'EST', 'NORD-OUEST', 
                    'SUD-OUEST']; 
        return view('dashboard.mining_zones', compact('permissions','users','regions')); 
    }
    public function mining_production(){}
    public function mining_sales(){}
    public function mining_logs(){}
}
