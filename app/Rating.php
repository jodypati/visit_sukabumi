<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $table = 'rating';
    protected $fillable = [ 'rate','rate_id','rate_type'];

    public function rate()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // public function penginapan(){
		//     return $this->belongsTo('App\Penginapan');
	  // }
}
