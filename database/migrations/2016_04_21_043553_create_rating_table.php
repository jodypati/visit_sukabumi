<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('user_id')->unsigned();
              $table->integer('rate_id');
              $table->integer('rating');
              $table->string('rate_type');
              $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');
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
        Schema::drop('rating');
    }
}
