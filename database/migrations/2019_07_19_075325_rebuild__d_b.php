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
<<<<<<< HEAD
=======
    // create tables
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
    public function up()
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->char('level', 6);
            $table->char('location', 5);
<<<<<<< HEAD
            $table->char('name', 10);
            $table->text('description');
            $table->longText('img1');
            $table->longText('img2');
            $table->longText('img3');
            $table->longText('img4');
            $table->longText('img5');
=======
            $table->string('name');
            $table->text('description');
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->char('longitude', 10)->nullable();;
            $table->char('latitude', 10)->nullable();;
            $table->tinyInteger('avg_rate')->nullable();;
            $table->longText('img1')->nullable();
            $table->longText('img2')->nullable();
            $table->longText('img3')->nullable();
            $table->longText('img4')->nullable();
            $table->longText('img5')->nullable();
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('service');
<<<<<<< HEAD
            $table->char('location', 5);
            $table->char('name', 10);
            $table->text('description');
=======
            $table->string('location', 5);
            $table->string('name');
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
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
            $table->longText('img1');
            $table->longText('img2');
            $table->longText('img3');
            $table->longText('img4');
            $table->longText('img5');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
<<<<<<< HEAD
            $table->string('userName', 20);
            $table->string('password', 10);
            $table->string('email', 30);
=======
            $table->string('name');
            $table->string('password');
            $table->string('email');
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
<<<<<<< HEAD
            $table->text('comment');
            $table->tinyInteger('rating');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('spot_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('spot_id')->references('id')->on('spots');
        });

        Schema::create('divingLogs', function (Blueprint $table) {
=======
            $table->text('comment')->default(NULL);
            $table->tinyInteger('rating');
            $table->string('commentable_type');
            $table->integer('commentable_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('logs', function (Blueprint $table) {
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
            $table->charset = 'utf8mb4';
            $table->collate = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
<<<<<<< HEAD
            $table->date('diving_date');
            $table->string('diving_site');
            $table->char('diving_mode', 4);
            $table->char('diving_type', 2);
            $table->tinyInteger('max_depth');
            $table->tinyInteger('avg_depth');
            $table->char('diving_time', 5);
            $table->unsignedTinyInteger('init_airPressure');
            $table->unsignedTinyInteger('end_airPressure');
=======
            $table->date('date');
            $table->string('site');
            $table->char('mode', 4);
            $table->char('type', 2);
            $table->tinyInteger('max_depth');
            $table->tinyInteger('avg_depth');
            $table->char('time', 5);
            $table->unsignedTinyInteger('init_air_pressure');
            $table->unsignedTinyInteger('end_air_pressure');
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
            $table->tinyInteger('percentage_of_oxygen');
            $table->tinyInteger('air_volume');
            $table->char('scuba_tank', 2);
            $table->tinyInteger('temp');
            $table->tinyInteger('water_temp');
            $table->char('weather', 2);
            $table->char('wave', 3);
            $table->char('currents', 3);
            $table->char('visibility', 3);
<<<<<<< HEAD
            $table->tinyInteger('suitThickness');
            $table->tinyInteger('weight');
            $table->text('log');
        });

=======
            $table->tinyInteger('suit_thickness');
            $table->tinyInteger('weight');
            $table->text('log');
        });
        // enable foreign key
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
<<<<<<< HEAD
=======
    // disable foreign key and drop tables
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('spots');
        Schema::dropIfExists('shops');
        Schema::dropIfExists('users');
        Schema::dropIfExists('comments');
<<<<<<< HEAD
        Schema::dropIfExists('divingLogs');
=======
        Schema::dropIfExists('logs');
>>>>>>> d3b0e86a78cd7cd53d8caed92ee715df994beff3
    }
}
