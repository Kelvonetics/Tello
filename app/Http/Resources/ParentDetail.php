<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentDetail extends JsonResource
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
            'registration_no' => $this->registration_no,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,       
            'phone' => $this->phone,
            'relationship' => $this->relationship,
            'created_by' => $this->created_by
        ];
    }
}
