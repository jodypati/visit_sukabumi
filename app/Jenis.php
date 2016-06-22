<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $fillable = [ 'nama'];

    public function fasilitas(){
        return $this->hasMany('\App\Fasilitas');
    }

    public function penginapan(){
        return $this->hasMany('\App\Penginapan');
    }

    public function restoran(){
        return $this->hasMany('\App\Restoran');
    }


}
