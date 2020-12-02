<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table='staff';



    
    public function designation()
    {
        return $this->belongsTo('App\Designation', 'designation_id');        
    }

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
}
