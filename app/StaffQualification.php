<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffQualification extends Model
{
    //
    protected $table='staff_qualifications';
    protected $fillable=['staff_no', 'instituite', 'course', 'grade', 'start_date', 'end_date', 'certificate', 'status_id', 'created_by'];
}
