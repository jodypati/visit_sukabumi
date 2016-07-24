<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    public $table = 'objek_wisata';
    protected $fillable = [ 'nama','alamat','jenis','deskripsi','foto_url','latitude','longitude'];

}
