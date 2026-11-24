<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerDetails extends Model
{
    protected $fillable=['project_id','year','month','bramin_f','bramin_m','dalit_f','dalit_m','janjati_f','janjati_m','muslim_f','muslim_m','others_f','others_m','local_f','local_m','skill_male','skill_female','unskill_male','unskill_female','status'];


     public function project(){

         return $this->belongsTo('App\Models\Projects');
         }
}
