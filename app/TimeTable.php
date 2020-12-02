<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    //
    protected $table='time_tables';


    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
    
    public function Monday()
    {
        return $this->belongsTo('App\Subject', 'monday');        
    }
    
    public function Tuesday()
    {
        return $this->belongsTo('App\Subject', 'tuesday');        
    }
    
    public function Wednesday()
    {
        return $this->belongsTo('App\Subject', 'wednesday');        
    }
    
    public function Thursday()
    {
        return $this->belongsTo('App\Subject', 'thursday');        
    }
    
    public function Friday()
    {
        return $this->belongsTo('App\Subject', 'friday');        
    }
}
