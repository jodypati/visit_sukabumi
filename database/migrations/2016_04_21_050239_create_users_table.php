<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('gender', ['L','P']);
            $table->string('avatarUrl');
            $table->string('country');
            $table->string('state');
            $table->string('address');
            $table->string('phone');
            $table->string('statusInfo');
            $table->string('tempatLahir');
            $table->date('tglLahir');
            $table->string('imgUsrFileName');
            $table->string('imgUsrFilePath');
            $table->timestamp('statusInfoUpAt');
            $table->string('gcm_id');
            $table->bigInteger('facebook_id')->unsigned()->index();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
