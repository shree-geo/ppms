<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvironmentalMonthlyRecord extends Model
{
    protected $fillable=['project_id','env_group_id','year','month','status','result','file','remarks','approve_status','status_date','issue','action','responsible_body','target_time'];
    
     public function project(){
         return $this->belongsTo('App\Models\Projects');
     }   
}
