<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterchangesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('interchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['canceled', 'checked', 'solicited', 'sending'])->default('solicited');
            $table->boolean('was_deleted')->default(false);
            $table->integer('article_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('interchanges');
    }
}
