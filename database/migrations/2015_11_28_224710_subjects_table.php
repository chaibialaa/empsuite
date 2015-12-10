<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('subject_csm', function (Blueprint $table) {
            $table->increments('id');
            $table->float('coefficient');

            $table->integer('subject_id')->unsigned();
            $table->integer('module_id')->unsigned();

            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('module_id')->references('id')->on('modules');
        });

        Schema::create('subject_pc',function (Blueprint $table){
            $table->increments('id');

            $table->integer('csm_id')->unsigned();
            $table->integer('professor_id')->unsigned();
            $table->integer('class_id')->unsigned();

            $table->foreign('csm_id')->references('id')->on('subject_csm');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('professor_id')->references('id')->on('users');
        });

        Schema::create('module_classes', function (Blueprint $table) {
            $table->integer('module_id')->unsigned();
            $table->integer('class_id')->unsigned();

            $table->foreign('module_id')->references('id')->on('modules');
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
        Schema::drop('subjects');
        Schema::drop('modules');
        Schema::drop('subject_cpm');
        Schema::drop('module_classes');
    }
}
