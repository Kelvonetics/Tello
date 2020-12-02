<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Classed extends JsonResource
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
            'class_name' => $this->class_name,
            'class_type' => $this->class_type,
            'session_id' => $this->session_id,
            'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'session' => $this->session
        ];
    }
}
