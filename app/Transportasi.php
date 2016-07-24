<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    public $table = 'transportasi';
    protected $fillable = [ 'nama','alamat','jenis','foto_url','latitude','longitude'];

}
