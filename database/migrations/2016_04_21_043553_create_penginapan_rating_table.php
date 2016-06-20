<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenginapanRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penginapan_rating', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('penginapan_id')->unsigned();
              $table->integer('rate');
              $table->foreign('penginapan_id')
                        ->references('id')->on('penginapan')
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
        Schema::drop('penginapan_rating');
    }
}
