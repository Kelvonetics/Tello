<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return
        [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'class_id' => $this->class_id,
            'term' => $this->term,
            'section_id' => $this->section_id,
            'questions' => $this->questions,
            'type_id' => $this->type_id,
            'group1' => $this->group1,
            'group2' => $this->group2,
            'group3' => $this->group3,
            'group4' => $this->group4,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'answer' => $this->answer,
            'subject' => $this->subject,
            'classed' => $this->classed
        ];
    }
}
