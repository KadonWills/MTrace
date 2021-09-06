<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function(Blueprint $table){
            $table->bigIncrements('id'); 
            $table->integer('userid'); 
            $table->integer('roleid');
            $table->foreign('userid')->on('users')->references('id');  
            $table->foreign('roleid')->on('users')->references('id');  
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_roles'); 
    }
}
