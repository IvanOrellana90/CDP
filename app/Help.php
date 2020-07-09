<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    public function support()
    {
        return $this->hasOne('App\Support');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
