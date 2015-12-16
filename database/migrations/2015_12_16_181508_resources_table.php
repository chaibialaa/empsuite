<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_statuses', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
        });

        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('status')->unsigned();
            $table->integer('places');
            $table->timestamps();
            $table->foreign('status')->references('id')->on('classroom_statuses');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classrooms');
        Schema::drop('classroom_statuses');
    }
}
