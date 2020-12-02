<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffSubject extends Model
{
    //
    protected $table='staff_subjects';
    protected $fillable=['staff_no', 'subject_id', 'class_id', 'session_id', 'created_by'];
}
