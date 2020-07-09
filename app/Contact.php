<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['phone','email'];

    public function urls () {
        return $this->hasMany('App\Url');
    }

}
