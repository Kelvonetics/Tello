<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'midname' => $this->midname,
            'lastname' => $this->lastname,
            'email' => $this->email,            
            'password' => $this->password,
            'class_id' => $this->class_id,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'state_id' => $this->state_id,
            'nationality' => $this->nationality,
            'category_id' => $this->category_id,
            'session_id' => $this->session_id,
            'photo' => $this->photo,
            'status_id' => $this->status_id,
            'created_by' => $this->created_by,
            'classed' => $this->classed,
            'session' => $this->session,
            'state' => $this->state
        ];
    }
}
