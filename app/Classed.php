<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classed extends Model
{
    //
    protected $table = 'classes';

    
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }

    public function Result()
    {
        return $this->hasMany('App\Result', 'class_id');        
    }

}
