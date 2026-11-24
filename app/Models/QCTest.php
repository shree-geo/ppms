<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QCTest extends Model
{
    protected $fillable = ['project_id','material_id', 'test_type_id', 'year','month','followed_code', 'test_date', 'test_location', 'result', 'test_by', 'obaserved_result', 'report_file', 'remarks','status','status_date','output_result'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }

    public function testType()
    {
        return $this->belongsTo('App\Models\TestType');
    }
    public function materials()
    {
        return $this->belongsTo('App\Models\Materials','material_id','id');
    }
}
