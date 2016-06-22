<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
              $table->increments('id');
              $table->string('komentar');
              $table->integer('comment_id');
              $table->string('comment_type');
              $table->integer('user_id')->unsigned();
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
        Schema::drop('komentar');
    }
}
