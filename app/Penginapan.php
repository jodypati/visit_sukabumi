<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    public $table = "penginapan";
    protected $fillable = [ 'nama', 'alamat', 'telepon', 'email', 'bintang', 'namaPemilik', 'jmlKamar', 'jmlTempatTidur', 'tarif', 'jenis', 'fasilitas', 'keterangan', 'foto_url', 'latitude', 'longitude'];


    public function rating(){
        //return $this->hasMany('\App\BumperRating');
        return $this->morphMany('App\Rating', 'rate');
    }
    public function komentar(){
        return $this->morphMany('\App\Komentar','comment');
    }

    public function unggulan(){
        return $this->belongsToMany('\App\Unggulan','unggulan_akomodasi','id_unggulan','id_penginapan');
    }

}
