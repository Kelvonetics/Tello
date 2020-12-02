<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempQuestion extends Model
{
    //
    protected $table='temp_questions';
    protected $fillable=['subject_id', 'class_id', 'term', 'section_id', 'questions', 'type_id', 'group1', 'group2', 'group3', 'group4', 'option1', 'option2', 'option3', 'option4', 'answer', 'question_id', 'question_no', 'registration_no', 'picked', 'answered', 'time_left', 'date', 'refresh', 'last_viewed', 'scores', 'created_by'];
}
