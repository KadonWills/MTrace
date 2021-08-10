<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string("username");
            $table->string("password");
            $table->date("dob")->nullable();
            $table->string("contact")->nullable();
            $table->string("prospector_card_num")->nullable();
            $table->string("profile_pic")->default("uploads/profile/default.png");
            $table->string("cni")->nullable();
            $table->string("profession")->nullable();
            $table->string("status")->default("ACTIVE");
            $table->integer("role_id")->foreign()->unsigned()->nullable();
            $table->foreign('role_id')
                ->unsigned()
                ->references('id')
                ->on('roles');
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
        Schema::dropIfExists('users');
    }
}
