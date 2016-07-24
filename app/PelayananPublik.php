<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelayananPublik extends Model
{
    public $table = 'pelayanan_publik';
    protected $fillable = [ 'nama','alamat','jenis','keterangan','foto_url','latitude','longitude'];

}
