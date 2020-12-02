<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Fee extends JsonResource
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
            'fee_name' => $this->fee_name,
            'fee_type_id' => $this->fee_type_id,
            'currency' => $this->currency,
            'amount' => $this->amount,
            'class_id' => $this->class_id,
            'session_id' => $this->session_id,
            'frequency' => $this->frequency,
            'status_id' => $this->status_id,
            'classed' => $this->classed,
            'session' => $this->session
        ];
    }
}
