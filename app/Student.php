<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table='students';
    
    protected $fillable = ['registration_no', 'firstname', 'midname', 'lastname', 'email', 'password', 'class_id', 'phone', 'address', 'gender', 'dob', 'state_id', 'nationality', 'category_id', 'session_id', 'photo', 'status_id', 'created_by'];



    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
    
    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');        
    }

    // public function category()
    // {
    //     return $this->belongsTo('App\Category', 'category_id');        
    //}

    public function Result()
    {
        return $this->hasMany('App\Result', 'registration_no');        
    }
}
