<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    //
    protected $table='results';
    protected $fillable=['session_id', 'applicant_id', 'category_id', 'scores', 'total_question', 'answered', 'answered_correct', 'answered_incorrect', 'un_answered', 'grade', 'time_used', 'date'];
}
