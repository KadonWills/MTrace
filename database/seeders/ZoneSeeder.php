<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mining_zones = [
            ['name' => 'Zone 1', 'user_id' => 2, 'geo_coord_utm_e' => '12.354', 'geo_coord_utm_n' => '7.369', 
            'geo_coord_dms_long' => '12.354', 'geo_coord_dms_lat' => '7.369', 'region' => 'CENTRE', 
            'division' => 'div1', 'subdivision' => 'subdiv1'], 
            ['name' => 'Zone 2', 'user_id' => 2, 'geo_coord_utm_e' => '12.354', 'geo_coord_utm_n' => '7.369', 
            'geo_coord_dms_long' => '12.354', 'geo_coord_dms_lat' => '7.369', 'region' => 'LITTORAL', 
            'division' => 'div2', 'subdivision' => 'subdiv2'], 
            ['name' => 'Zone 3', 'user_id' => 2, 'geo_coord_utm_e' => '12.354', 'geo_coord_utm_n' => '7.369', 
            'geo_coord_dms_long' => '12.354', 'geo_coord_dms_lat' => '7.369', 'region' => 'OUEST', 
            'division' => 'div3', 'subdivision' => 'subdiv3'], 
            ['name' => 'Zone 4', 'user_id' => 2, 'geo_coord_utm_e' => '12.354', 'geo_coord_utm_n' => '7.369', 
            'geo_coord_dms_long' => '12.354', 'geo_coord_dms_lat' => '7.369', 'region' => 'ADAMAOUA', 
            'division' => 'div4', 'subdivision' => 'subdiv4'], 
            ['name' => 'Zone 5', 'user_id' => 2, 'geo_coord_utm_e' => '12.354', 'geo_coord_utm_n' => '7.369', 
            'geo_coord_dms_long' => '12.354', 'geo_coord_dms_lat' => '7.369', 'region' => 'EXTREME-NORD', 
            'division' => 'div5', 'subdivision' => 'subdiv5']
        ];

        foreach ($mining_zones as $mining_zone) {
            DB::table('mining_zones')->insert($mining_zone); 
        }
    }
}
