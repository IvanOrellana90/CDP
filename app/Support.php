<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = ['number_beneficiaries','beneficiary_category_id','description'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function event()
    {
        return $this->hasOne('App\Event');
    }

    public function help()
    {
        return $this->belongsTo('App\Event');
    }

    public function organization()
    {
        return $this->hasOne('App\Organization');
    }

    public function beneficiaries()
    {
        return $this->belongsToMany('App\Category','beneficiary_support');
    }
}
