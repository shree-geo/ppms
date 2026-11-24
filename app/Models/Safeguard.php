<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Safeguard extends Model
{
    protected $fillable=['project_id','ddr_status','ddr_date','ir_status','ir_date','ipp_status','ipp_date'];

     public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
