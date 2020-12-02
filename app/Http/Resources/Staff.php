<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Staff extends JsonResource
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
            'firstname' => $this->firstname,
            'midname' => $this->midname,
            'lastname' => $this->lastname,
            'email' => $this->email,            
            'password' => $this->password,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'doj' => $this->doj,
            'marital_status' => $this->marital_status,
            'designation_id' => $this->designation_id,
            'state_id' => $this->state_id,
            'nationality' => $this->nationality,
            'photo' => $this->photo,
            'session_id' => $this->session_id,
            'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'designation' => $this->designation,
            'state' => $this->state,
            'session' => $this->session
        ];
    }
}
