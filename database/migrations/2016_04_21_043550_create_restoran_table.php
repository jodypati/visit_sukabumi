<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestoranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restoran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_id')->unsigned();
            $table->string('name');
            $table->string('alamat');
            $table->string('namaPemilik');
            $table->integer('jmlMeja');
            $table->integer('jmlKursi');
            $table->integer('hidangan');
            $table->string('telepon');
            $table->foreign('jenis_id')
                      ->references('id')->on('jenis')
                      ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('restoran_fasilitas', function (Blueprint $table) {
            $table->integer('restoran_id')->unsigned();
            $table->integer('fasilitas_id')->unsigned();
            $table->foreign('restoran_id')
                      ->references('id')->on('restoran')
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
        Schema::drop('restoran');
        Schema::drop('restoran_fasilitas');
    }
}
