<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamPin extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'pin' => $this->pin,
            'class_id' => $this->class_id,
            'term' => $this->term,
            'session_id' => $this->session_id,
            'registration_no' => $this->registration_no,
            'date' => $this->date,
            'no_of_questions' => $this->no_of_questions,
            'duration' => $this->duration,
            'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'subject' => $this->subject,
            'classed' => $this->classed,
            'session' => $this->session
        ];
    }
}
