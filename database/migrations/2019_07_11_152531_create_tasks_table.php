<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dive Sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('viewName', 10);
            $table->char('level', 2);
            $table->char('location', 2);
            $table->string('viewDiscription');
            $table->tinyInteger('avgRate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Dive Sites');
    }
}
