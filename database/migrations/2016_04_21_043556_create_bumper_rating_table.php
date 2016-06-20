<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumperRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bumper_rating', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('bumper_id')->unsigned();
              $table->integer('rate');
              $table->foreign('bumper_id')
                        ->references('id')->on('bumper')
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
        Schema::drop('bumper_rating');
    }
}
