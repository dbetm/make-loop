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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 65);
            $table->string('last_name', 65);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('points')->unsigned();
            $table->boolean('is_active')->default(false);
            $table->boolean('was_deleted')->default(false);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('image', 255)->nullable();
            $table->string('country', 65)->nullable();
            $table->string('state', 65)->nullable();
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
