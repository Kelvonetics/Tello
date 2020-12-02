<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $table='school_sessions';



    public function Student()
    {
        return $this->hasMany('App\Student', 'session_id');
    }
}
