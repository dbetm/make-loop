<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('city', 255);
            $table->bigInteger('points')->unsigned();
            $table->string('shipping_way', 255);
            $table->decimal('price', 6, 2)->nullable();
            $table->enum('status', ['new', 'good', 'regular'])->default('good');
            $table->boolean('is_active')->default(true);
            $table->boolean('was_deleted')->default(false);
            $table->string('image', 255)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
        Schema::drop('categories');
    }
}
