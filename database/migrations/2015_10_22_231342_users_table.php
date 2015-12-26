<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',20);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('adress')->nullable();
            $table->integer('phone')->nullable();
            $table->string('imagepath')->nullable();
            $table->char('sexe', 1)->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->string('validation');
            $table->date('datenaissance')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->unique();
            $table->string('language')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
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
        Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('sessions');
    }
}
