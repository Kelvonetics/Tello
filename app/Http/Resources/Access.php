<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Access extends JsonResource
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
            'who_can_access' => $this->who_can_access,
            'exam_date' => $this->exam_date,
            'exam_code' => $this->exam_code,
            'notify_who' => $this->notify_who,
            'when_to_notify' => $this->when_to_notify
        ];
    }
}
