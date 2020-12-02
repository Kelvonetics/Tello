<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultRemark extends Model
{
    //
    protected $table='result_remarks';
    protected $fillable=['result_id', 'student_id', 'overall', 'overall_grade', 'recomendation', 'remark', 'signature_1', 'signature_2', 'created_by'];
    

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function result()
    {
        return $this->belongsTo('App\Result', 'result_id');
    }
}
