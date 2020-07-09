<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    public function event()
    {
        return $this->hasOne('App\Event');
    }

    public function region()
    {
        return $this->hasOne('App\Region');
    }

    public function commune()
    {
        return $this->belongsTo('App\Commune');
    }
}
