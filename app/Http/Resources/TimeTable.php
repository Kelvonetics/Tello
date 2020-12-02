<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeTable extends JsonResource
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
            'session_id' => $this->session_id,
            'class_id' => $this->class_id,
            'term_id' => $this->term_id,
            'week' => $this->week,            
            'time_slot' => $this->time_slot,
            'monday' => $this->monday,
            'tuesday' => $this->tuesday,
            'wednesday' => $this->wednesday,
            'thursday' => $this->thursday,
            'friday' => $this->friday,
            'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'approved_by' => $this->approved_by,
            'approved_at' => $this->approved_at,
            'classed' => $this->classed,
            'session' => $this->session,
            'Monday' => $this->Monday,
            'Tuesday' => $this->Tuesday,
            'Wednesday' => $this->Wednesday,
            'Thursday' => $this->Thursday,
            'Friday' => $this->Friday
        ];
    }
}
