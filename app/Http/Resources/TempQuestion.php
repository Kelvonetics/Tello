<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TempQuestion extends JsonResource
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
            'category_id' => $this->category_id,
            'section_id' => $this->section_id,
            'questions' => $this->questions,
            'exam_type' => $this->exam_type,
            'group1' => $this->group1,
            'group2' => $this->group2,
            'group3' => $this->group3,
            'group4' => $this->group4,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'answer' => $this->answer
        ];
    }
}
