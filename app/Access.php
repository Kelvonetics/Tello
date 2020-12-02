<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    //
    protected $table='accesses';
    protected $fillable=['exam_id', 'who_can_access', 'exam_date', 'exam_code', 'notify_who', 'when_to_notify', 'created_by'];
}
