<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Session extends JsonResource
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
            'session_name' => $this->session_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
