<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bumper extends Model
{
    public $table = 'bumi_perkemahan';
    protected $fillable = ['alamat','telepon','pemilik','luasLahan','tarif'];

    public function rating(){
        //return $this->hasMany('\App\BumperRating');
        return $this->morphMany('App\Rating', 'rating');
    }
    public function komentar(){
        return $this->morphMany('\App\Komentar','komentar');
    }


}
