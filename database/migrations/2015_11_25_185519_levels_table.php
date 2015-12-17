<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });


        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->integer('section_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->timestamps();
        });



        Schema::create('user_classes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->string('user_func');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('class_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('levels');
        Schema::drop('classes');
        Schema::drop('sections');
        Schema::drop('user_classes');
    }
}
