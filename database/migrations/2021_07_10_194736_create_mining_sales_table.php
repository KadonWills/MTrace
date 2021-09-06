<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiningSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mining_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sale_date');
            $table->string('diamond_num')->nullable();
            $table->string('gold_qty')->nullable();
            $table->string('weight'); // { gold => carat, diamond => grams}
            $table->string('value'); //FCFA
            $table->string("prospector_card_num");
            $table->string('collector_receipt_num');
            $table->string('collector_fullname');
            $table->integer('collector_id')->foreign()->unsigned()->nullable(); //the id of the person purchasing if in the system
            $table->foreign('collector_id')
            ->unsigned()
            ->references('id')
            ->on('users');
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
        Schema::dropIfExists('mining_sales');
    }
}
