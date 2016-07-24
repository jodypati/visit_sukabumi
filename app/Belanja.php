<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    public $table = 'belanja';
    protected $fillable = [ 'nama','alamat','jenis','keterangan','foto_url','latitude','longitude'];

}
