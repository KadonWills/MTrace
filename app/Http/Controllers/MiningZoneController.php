<?php

namespace App\Http\Controllers;

use App\Models\MiningZone;
use App\Models\User;
use Illuminate\Http\Request;

class MiningZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mining_zones = MiningZone::all();
        foreach ($mining_zones as $mining_zone) {
            $mining_zone->action = "<a href='javascript:void(0)' data-toggle='tooltip'  data-mapper='show' data-id='" . $mining_zone->id . "' data-original-title='show' class='btn btn-success btn-sm'><i class='fas fa-eye' data-mapper='show' data-id='" . $mining_zone->id . "' ></i></a>" .
                "<a href='javascript:void(0)' data-toggle='tooltip' data-mapper='edit' data-id='" . $mining_zone->id . "' data-original-title='Edit' class='btn btn-primary btn-sm mx-1'><i class='fas fa-edit' data-mapper='edit' data-id='" . $mining_zone->id . "' ></i></a>" .
                "<a href='javascript:void(0)' data-toggle='tooltip' data-mapper='delete' data-id='" . $mining_zone->id . "' data-original-title='Delete' class='btn btn-danger btn-sm'><i class='fas fa-trash' data-mapper='delete' data-id='" . $mining_zone->id . "' ></i></a>";
            $user = User::find($mining_zone->user_id); 
            $mining_zone->geo_coord_utm = $mining_zone->geo_coord_utm_e . ',' . $mining_zone->geo_coord_utm_n ;  
            $mining_zone->geo_coord_dms = $mining_zone->geo_coord_dms_long . ',' . $mining_zone->geo_coord_dms_lat ;  
            $mining_zone->user_firstname = $user->firstname . ' ' . $user->lastname ; 
        }

        echo \json_encode($mining_zones);
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
