<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    //

    public function exam()
    {
        return $this->belongsTo('App\ExamType', 'exam_id');        
    }

    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id');        
    }
}
