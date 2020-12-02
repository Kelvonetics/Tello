<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    //
    protected $table='parent_details';    
    protected $fillable=['registration_no', 'title', 'firstname', 'lastname', 'email', 'phone', 'relationship', 'created_by'];
}
