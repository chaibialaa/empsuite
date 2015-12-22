<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->unsigned();

            $table->foreign('type')->references('id')->on('timetable_types');
            $table->timestamps();
        });

        Schema::create('timetable_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        Schema::create('timetable_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timetable')->unsigned();
            $table->time('startTime');
            $table->time('endTime');
            $table->date('date')->nullable();
            $table->string('color');
            $table->string('day')->nullable();
            $table->integer('classroom')->unsigned();
            $table->integer('subject_pc')->unsigned();

            $table->foreign('timetable')->references('id')->on('timetables');
            $table->foreign('classroom')->references('id')->on('classrooms');
            $table->foreign('subject_pc')->references('id')->on('subject_pc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timetables');
        Schema::drop('timetable_types');
        Schema::drop('timetable_elements');
    }
}
