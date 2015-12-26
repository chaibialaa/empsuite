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
        Schema::create('core_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('type');
            $table->integer('status')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('core_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('backend_theme')->unsigned();
            $table->integer('frontend_theme')->unsigned();
            $table->string('catchmail');
            $table->timestamps();

            $table->foreign('backend_theme')->references('id')->on('core_themes');
            $table->foreign('frontend_theme')->references('id')->on('core_themes');
        });

        Schema::create('core_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->string('flag');
            $table->integer('status')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::create('core_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });

        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->integer('user_id')->unsigned();
            $table->integer('module_id')->unsigned();
            $table->string('element');
            $table->timestamp('datetime');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('module_id')->references('id')->on('core_modules');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_settings');
        Schema::drop('core_languages');
        Schema::drop('core_modules');
        Schema::drop('core_themes');

    }
}
