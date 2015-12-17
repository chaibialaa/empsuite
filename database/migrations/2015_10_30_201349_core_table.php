<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->integer('status')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('core', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('backend_theme')->unsigned();
            $table->integer('frontend_theme')->unsigned();
            $table->string('catchmail');
            $table->timestamps();

            $table->foreign('backend_theme')->references('id')->on('themes');
            $table->foreign('frontend_theme')->references('id')->on('themes');
        });

        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->string('flag');
            $table->integer('status')->default(0)->nullable();
            $table->timestamps();
        });



        Schema::create('sessions', function ($table) {
            $table->string('id')->unique();
            $table->text('payload');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on(config('auth.table'))->onDelete('cascade');
            $table->integer('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core');
        Schema::drop('language');
        Schema::drop('sessions');
        Schema::drop('themes');

    }
}
