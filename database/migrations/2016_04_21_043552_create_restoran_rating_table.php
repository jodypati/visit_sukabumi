<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestoranRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restoran_rating', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('restoran_id')->unsigned();
              $table->integer('rate');
              $table->foreign('restoran_id')
                        ->references('id')->on('restoran')
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
        Schema::drop('restoran_rating');
    }
}
