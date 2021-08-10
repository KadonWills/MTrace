<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mining_productions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('prod_date');
            $table->string('labour_name');
            $table->string('site');
            $table->string('river')->nullable();
            $table->string('diamond_num')->nullable();
            $table->string('gold_qty')->nullable();
            $table->string('weight'); // { gold => carat, diamond => grams}
            $table->integer('mining_zone_id')->foreign()->unsigned();
            $table->foreign('mining_zone_id')
            ->unsigned()
            ->references('id')
            ->on('mining_zones');
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
        Schema::dropIfExists('mining_productions');
    }
}
