<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table='results';
    protected $fillable=['subject_id', 'class_id', 'term', 'session_id', 'registration_no', 'scores', 'total_question', 'answered', 'answered_correct', 'answered_incorrect', 'un_answered', 'grade', 'time_used', 'date'];
    

    public function student()
    {
        return $this->belongsTo('App\Student', 'registration_no');
    }

    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');
    }
}
