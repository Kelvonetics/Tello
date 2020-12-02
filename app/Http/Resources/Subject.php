<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subject extends JsonResource
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
            'subject_name' => $this->subject_name,
            'subject_type' => $this->subject_type,
            'class_id' => $this->class_id,
            'status_id' => $this->status_id,
            'session_id' => $this->session_id,
            'created_by' => $this->created_by,
            'classed' => $this->classed,
            'session' => $this->session
        ];
    }
}
