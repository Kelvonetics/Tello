<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffQualification extends JsonResource
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
            'instituite' => $this->instituite,
            'course' => $this->course,
            'grade' => $this->grade,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'certificate' => $this->certificate,
            'status_id' => $this->status_id
        ];
    }
}
