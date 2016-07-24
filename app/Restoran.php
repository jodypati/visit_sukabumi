<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    public $table = 'restoran';
    protected $fillable = [ 'nama', 'alamat', 'keterangan', 'telepon', 'namaPemilik', 'jenis', 'jmlMeja', 'jmlKursi', 'hidangan', 'foto_url', 'latitude', 'longitude'];

    public function rating(){
        //return $this->hasMany('\App\BumperRating');
        return $this->morphMany('App\Rating', 'rating');
    }
    public function komentar(){
        return $this->morphMany('\App\Komentar','komentar');
    }
}
