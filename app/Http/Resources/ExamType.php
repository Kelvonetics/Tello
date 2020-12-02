<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamType extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
    
    // public function toArray($request)
    // {
    //     //return parent::toArray($request);
    //     return
    //     [
    //         'id' => $this->id,
    //         'test_name' => $this->test_name,
    //         'session_id' => $this->session_id,
    //         'class_id' => $this->class_id,
    //         'subject_id' => $this->subject_id,
    //         'no_of_questions' => $this->no_of_questions,
    //         'mark_per_question' => $this->mark_per_question,
    //         'duration' => $this->duration,
    //         'user_id' => $this->user_id
    //     ];
    // }
}
