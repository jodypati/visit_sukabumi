<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'name','email','telepon','alamat','avatarURL','verified','password'
    ];

    public function komentar(){
        return $this->hasOne('\App\Komentar');
    }

    public function rating(){
        return $this->hasOne('\App\Rating');
    }


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = [
    //    'password', 'remember_token',
    //];
}
