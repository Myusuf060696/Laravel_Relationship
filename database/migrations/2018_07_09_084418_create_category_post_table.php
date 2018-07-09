<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Penamaannya alphabet, cari C ke P
         */
        Schema::create('category_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            // $table->foreign('post_id')->references('id')->on('posts');
            $table->integer('category_id')->unsigned();
            // $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('category_post');
    }
}