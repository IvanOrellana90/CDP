<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name','rut','support_id','operation_id','category_id'];
    
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function directions()
    {
        return $this->belongsToMany('App\Direction');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    public function support()
    {
        return $this->belongsTo('App\Support');
    }

    public function operation()
    {
        return $this->belongsTo('App\Category', 'operation_id');
    }
}
