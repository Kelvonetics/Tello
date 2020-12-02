<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    // protected $table = 'exam_types';
 
    // protected $fillable = ['test_name', 'test_type', 'duration', 'points_per_question', 'pass_mark','test_coordinator'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');        
    }


    public function exam()
    {
        return $this->belongsTo('App\ExamType', 'exam_id');
    }


    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');
    }


    public function class()
    {
        return $this->belongsTo('App\Classed', 'class_id');
    }


    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');
    }

}
