<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function getUserPermission(){
        $roles = DB::table('users_roles')
                        ->join('users', 'users.id', '=', 'users_roles.userid')
                        ->join('roles', 'roles.id', '=', 'users_roles.roleid')
                        ->where('users.id', '=', Auth()->user()->id)
                        ->select('roles.id')
                        ->get()->toArray();
        $permissions  = []; 
        $user_permissions = []; 
        foreach ($roles as $role) {
            $roles_permissions = DB::table('roles_permissions')
                                ->join('roles', 'roles.id', '=', 'roles_permissions.roleid') 
                                ->join('permissions', 'permissions.id', '=', 'roles_permissions.permissionid') 
                                ->where('roles.id', '=', $role->id)
                                ->select('permissions.code')
                                ->get()->toArray();
            $permissions = array_merge($permissions, $roles_permissions);    
        }
        foreach ($permissions  as $permission) {
            array_push($user_permissions, $permission->code); 
        }
        return $user_permissions;
    }

    public static function getUsersWithRole(){
        $users_roles = DB::table('users_roles')
                            ->join('users', 'users.id', '=', 'users_roles.userid')
                            ->join('roles', 'roles.id', '=', 'users_roles.roleid'); 
        return $users_roles; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->action = "<a href='javascript:void(0)' data-toggle='tooltip'  data-mapper='show' data-id='" . $user->id . "' data-original-title='show' class='btn btn-success btn-sm'><i class='fas fa-eye' data-mapper='show' data-id='" . $user->id . "' ></i></a>" .
                "<a href='javascript:void(0)' data-toggle='tooltip' data-mapper='edit' data-id='" . $user->id . "' data-original-title='Edit' class='btn btn-primary btn-sm mx-1'><i class='fas fa-edit' data-mapper='edit' data-id='" . $user->id . "' ></i></a>" .
                "<a href='javascript:void(0)' data-toggle='tooltip' data-mapper='delete' data-id='" . $user->id . "' data-original-title='Delete' class='btn btn-danger btn-sm'><i class='fas fa-trash' data-mapper='delete' data-id='" . $user->id . "' ></i></a>";
            $user->image = asset($user->profile_pic);
            $user->firstname = $user->firstname . ' ' . $user->lastname; 
            $user_roles = DB::table('users_roles')
                            ->join('users', 'users.id', '=', 'users_roles.userid')
                            ->join('roles', 'roles.id', '=', 'users_roles.roleid')
                            ->where('users.id', '=', $user->id)
                            ->select('roles.*')
                            ->get()->toArray();
            $user->fonction = $user_roles[0]->name; 
            $user->role_id = $user_roles[0]->id;
        }

        echo \json_encode($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
