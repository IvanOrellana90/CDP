<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function regions()
    {
        return $this->belongsToMany('App\Region');
    }

    public function communes()
    {
        return $this->belongsToMany('App\Commune');
    }

    public function directions()
    {
        return $this->belongsToMany('App\Direction');
    }

    public function organization()
    {
        return $this->hasOne('App\Organization');
    }
}
