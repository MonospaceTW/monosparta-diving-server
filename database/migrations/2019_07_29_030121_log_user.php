<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // this function creates log_user pivot table
    public function up()
    {
        Schema::create('log_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('log_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('log_id')->references('id')->on('logs');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // this function drops log_user table
    public function down()
    {
        Schema::dropIfExists('log_user');
    }
}
