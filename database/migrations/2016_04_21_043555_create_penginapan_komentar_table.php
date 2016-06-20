<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenginpanKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penginapan_komentar', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('penginapan_id')->unsigned();
              $table->string('komentar');
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
        Schema::drop('penginapan_komentar');
    }
}
