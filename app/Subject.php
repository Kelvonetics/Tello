<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $table='subjects';
    
    protected $fillable = ['subject_name', 'subject_type', 'class_id', 'session_id', 'status_id', 'created_by'];



    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }


}

