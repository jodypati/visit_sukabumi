<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    public $table = 'aktivitas';
    protected $fillable = [ 'nama','deskripsi','foto_url'];

}
