<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
}
