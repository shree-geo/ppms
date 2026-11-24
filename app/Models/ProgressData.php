<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressData extends Model
{
    protected $fillable=['project_id','revision','year','month','month_code','target','progress','financial_progress','approve_rpmo','approve_rpmo_date','approve_rpmo_user_id','approve_pmo','approve_pmo_date','approve_pmo_user_id','dispercement'];

    public function project(){
        return $this->belongsTo('App\Models\projects');
    }
}
