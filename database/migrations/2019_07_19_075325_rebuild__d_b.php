<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->char('level', 6);
            $table->char('location', 5);
            $table->char('name', 10);
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->text('description');
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->char('longitude', 10)->nullable();;
            $table->char('latitude', 10)->nullable();;
            $table->tinyInteger('avgRate')->nullable();;
            $table->longText('img1')->nullable();
            $table->longText('img2')->nullable();
            $table->longText('img3')->nullable();
            $table->longText('img4')->nullable();
            $table->longText('img5')->nullable();
        });

        Schema::create('shop', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('service');
            $table->char('location', 5);
            $table->char('name', 10);
            $table->text('description');
            $table->tinyInteger('avg_rate')->nullable();
            $table->text('bh')->nullable();
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->char('phone1', 12)->nullable();
            $table->char('phone2', 12)->nullable();
            $table->longText('web1')->nullable();
            $table->longText('web2')->nullable();
            $table->char('longitude', 10);
            $table->char('latitude', 10);
            $table->longText('img1');
            $table->longText('img2');
            $table->longText('img3');
            $table->longText('img4');
            $table->longText('img5');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('password');
            $table->string('email');
        });

        Schema::create('comment', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('comment');
            $table->tinyInteger('rating');
            $table->bigInteger('user_id')->unsigned()->nullable();;
            $table->bigInteger('shop_id')->unsigned()->nullable();;
            $table->bigInteger('spot_id')->unsigned()->nullable();;
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('spot_id')->references('id')->on('spots');
        });

        Schema::create('divingLogs', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('date');
            $table->string('site');
            $table->char('mode', 4);
            $table->char('type', 2);
            $table->tinyInteger('max_depth');
            $table->tinyInteger('avg_depth');
            $table->char('time', 5);
            $table->unsignedTinyInteger('init_airPressure');
            $table->unsignedTinyInteger('end_airPressure');
            $table->tinyInteger('percentage_of_oxygen');
            $table->tinyInteger('air_volume');
            $table->char('scuba_tank', 2);
            $table->tinyInteger('temp');
            $table->tinyInteger('water_temp');
            $table->char('weather', 2);
            $table->char('wave', 3);
            $table->char('currents', 3);
            $table->char('visibility', 3);
            $table->tinyInteger('suit_thickness');
            $table->tinyInteger('weight');
            $table->text('log');
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
        Schema::dropIfExists('spot');
        Schema::dropIfExists('shop');
        Schema::dropIfExists('user');
        Schema::dropIfExists('comment');
        Schema::dropIfExists('log');
    }
}
