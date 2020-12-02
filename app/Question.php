<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'questions';
    protected $fillable=['subject_id', 'class_id', 'term', 'section_id', 'questions', 'type_id', 'group1', 'group2', 'group3', 'group4', 'option1', 'option2', 'option3', 'option4', 'answer', 'created_by'];

    
    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id');        
    }
    
    public function classed()
    {
        return $this->belongsTo('App\Classed', 'class_id');        
    }
}
