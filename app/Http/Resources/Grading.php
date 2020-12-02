<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Grading extends JsonResource
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
            'exam_id' => $this->exam_id,
            'session_id' => $this->session_id,
            'grade_name' => $this->grade_name,
            'from' => $this->from,
            'to' => $this->to,
            'description' => $this->description,
            'exam' => $this->exam,
            'session' => $this->session
        ];
    }
}
