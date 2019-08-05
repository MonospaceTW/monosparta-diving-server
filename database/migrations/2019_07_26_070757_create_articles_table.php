<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // this function creates articles table
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->char('category',10);
            $table->longText('img');
            $table->char('date',10);
            $table->string('author',50);
            $table->string('title');
            $table->string('content');
            $table->longText('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // this function drops articles table
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
