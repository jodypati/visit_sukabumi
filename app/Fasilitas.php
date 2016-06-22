<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable = ['name','jenis_id'];

    public function jenis(){
		    return $this->belongsTo('App\Jenis');
	  }

    public function bumper(){
        return $this->belongsToMany('\App\Bumper');
    }
    public function penginapan(){
        return $this->belongsToMany('\App\Penginapan');
    }
    public function restoran(){
        return $this->belongsToMany('\App\Restoran');
    }

}
