<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    public $table = 'restoran';
    protected $fillable = [ 'nama','alamat','namaPemilik','jmlMeja','jmlKursi','hidangan','telepon','jenis_id'];

    public function jenis(){
		    return $this->belongsTo('App\Jenis');
	  }

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
