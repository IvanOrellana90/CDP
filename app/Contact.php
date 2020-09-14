<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function event () {
        return $this->hasOne('App\Event');
    }

    public function organization () {
        return $this->hasOne('App\Organization');
    }

}
