<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function direction() {

        return hasOne('App\Direction');

    }
}
