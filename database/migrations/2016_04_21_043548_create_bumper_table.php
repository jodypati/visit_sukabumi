<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBumperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bumper', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alamat');
            $table->string('pemilik');
            $table->integer('luasLahan');
            $table->integer('tarif');
            $table->timestamps();
        });

        Schema::create('bumper_fasilitas', function (Blueprint $table) {
            $table->integer('bumper_id')->unsigned();
            $table->integer('fasilitas_id')->unsigned();
            $table->foreign('bumper_id')
                      ->references('id')->on('bumper')
                      ->onDelete('cascade');
            $table->foreign('fasilitas_id')
                      ->references('id')->on('fasilitas')
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
        Schema::drop('bumper');
        Schema::drop('bumper_fasilitas');
    }
}
