<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPin extends Model
{
    //
    protected $table='exam_code';
    
    protected $fillable = ['subject_id', 'pin', 'class_id', 'term', 'session_id', 'registration_no', 'date', 'no_of_questions', 'duration', 'status_id', 'created_by'];



    
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');        
    }
    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
    
    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
}
