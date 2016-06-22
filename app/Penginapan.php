<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    public $table = "penginapan";
    protected $fillable = [ 'nama','alamat','namaPemilik','jmlKamar','jmlTempatTidur','tarif','bintang','telepon','email','jenis_id'];

    public function jenis(){
		    return $this->belongsTo('App\Jenis');
	  }

    public function rating(){
        //return $this->hasMany('\App\BumperRating');
        return $this->morphMany('App\Rating', 'rate');
    }
    public function komentar(){
        return $this->morphMany('\App\Komentar','comment');
    }

    public function fasilitas(){
        return $this->belongsToMany('\App\Fasilitas')->withTimestamps();
    }
}
