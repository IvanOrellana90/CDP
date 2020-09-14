<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    public function direction() {

        return hasOne('App\Direction');

    }
}
