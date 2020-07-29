<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function support()
    {
        return $this->belongsTo('App\Support');
    }

    public function organizations()
    {
        return $this->belongsToMany('App\Organization');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function direction()
    {
        return $this->belongsTo('App\Direction');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function dates()
    {
        return $this->hasMany('App\Date');
    }
}
