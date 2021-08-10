<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mining_zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('user_id')->foreign()->unsigned();
            $table->foreign('user_id')
            ->unsigned()
            ->references('id')
            ->on('users');
            $table->string('geo_coord_utm_e');
            $table->string('geo_coord_utm_n');
            $table->string('geo_coord_dms_long');
            $table->string('geo_coord_dms_lat');
            $table->string('subdivision');
            $table->string('division');
            $table->string('region');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mining_zones');
    }
}
