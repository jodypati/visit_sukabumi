<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeniBudaya extends Model
{
    public $table = 'seni_budaya';
    protected $fillable = [ 'nama','deskripsi','foto_url','latitude','longitude'];

}
