<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
   protected $fillable=['project_id','issue','grievance_level','complain_by','complain_date','affected_site','action_taken','current_status','remarks','files','complain_source'];
    
   
   public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
