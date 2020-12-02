<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    //
    protected $table='exam_users';
    
    protected $fillable = ['exam_id', 'firstname', 'lastname', 'email', 'password', 'phone', 'address', 'dob', 'gender', 'marital_status', 'state_id', 'nationality', 'photo', 'code', 'created_by'];
}
