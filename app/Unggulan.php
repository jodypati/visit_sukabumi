<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unggulan extends Model
{
    public $table = 'unggulan';
    protected $fillable = ['nama', 'alamat', 'deskripsi', 'foto_url', 'amenities', 'attraction', 'ancilliary', 'accessibility', 'activities', 'latitude', 'longitude'];

    public function penginapan(){
        return $this->belongsToMany('\App\Penginapan','unggulan_akomodasi','id_unggulan','id_penginapan');
    }

}
