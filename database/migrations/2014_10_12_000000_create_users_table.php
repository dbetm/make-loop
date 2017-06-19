<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 65);
            $table->string('last_name', 65);
            $table->string('email')->unique();
            $table->string('password'); //default-length 255
            $table->string('bio');
            $table->integer('points')->unsigned()->default(100);
            $table->boolean('is_active')->default(false); //para controlar si puede publicar o no
            $table->boolean('was_deleted')->default(false); //para simular que se 'borró'
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
    }
}
