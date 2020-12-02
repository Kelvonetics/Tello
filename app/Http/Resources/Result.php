<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Result extends JsonResource
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
            'session_id' => $this->session_id,
            'applicant_id' => $this->applicant_id,
            'category_id' => $this->category_id,
            'scores' => $this->scores,
            'total_question' => $this->total_question,
            'answered' => $this->answered,
            'answered_correct' => $this->answered_correct,
            'answered_incorrect' => $this->answered_incorrect,
            'un_answered' => $this->un_answered,
            'grade' => $this->grade,
            'time_used' => $this->time_used,
            'date' => $this->date
        ];
    }
}
