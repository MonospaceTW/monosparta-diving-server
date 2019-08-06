<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('spot_id');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('spot_id')->references('id')->on('spots');

        });
        Schema::create('spot_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('shop_id');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('spot_comments');
        Schema::dropIfExists('shop_comments');
    }
}
