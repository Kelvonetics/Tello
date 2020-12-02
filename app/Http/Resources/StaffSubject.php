<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffSubject extends JsonResource
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
            'staff_no' => $this->staff_no,
            'subject_id' => $this->subject_id,
            'class_id' => $this->class_id,
            'session_id' => $this->session_id,
            'created_by' => $this->created_by
        ];
    }
}
