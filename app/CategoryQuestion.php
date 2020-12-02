<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    //
    protected $table = 'category_questions';
    protected $fillable=['category_id', 'section_id', 'questions', 'exam_type', 'group1', 'group2', 'group3', 'group4', 'option1', 'option2', 'option3', 'option4', 'answer', 'created_by'];
}
