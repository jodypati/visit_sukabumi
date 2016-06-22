<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bumper extends Model
{
    public $table = 'bumper';
    protected $fillable = ['alamat','pemilik','luasLahan','tarif'];

    public function rating(){
        //return $this->hasMany('\App\BumperRating');
        return $this->morphMany('App\Rating', 'rating');
    }
    public function komentar(){
        return $this->morphMany('\App\Komentar','komentar');
    }

    public function fasilitas(){
        return $this->belongsToMany('\App\Fasilitas')->withTimestamps();
    }

}
