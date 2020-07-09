<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function helps() {

        return Date::where('upper','5')->get();

    }
}
