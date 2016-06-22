<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenginapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penginapan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_id')->unsigned();
            $table->string('name');
            $table->string('alamat');
            $table->string('namaPemilik');
            $table->integer('jmlKamar');
            $table->integer('jmlTempatTidur');
            $table->integer('tarif');
            $table->integer('bintang');
            $table->string('telepon');
            $table->string('email');
            $table->foreign('jenis_id')
                      ->references('id')->on('jenis')
                      ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('penginapan_fasilitas', function (Blueprint $table) {
            $table->integer('penginapan_id')->unsigned();
            $table->integer('fasilitas_id')->unsigned();
            $table->foreign('penginapan_id')
                      ->references('id')->on('penginapan')
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
        Schema::drop('penginapan');
        Schema::drop('penginapan_fasilitas');
    }
}
