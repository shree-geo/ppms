<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
   protected $fillable=['project_id','project_type_id','existing_treatment_detail','proposed_treatment_detail','base_year_pvt_connection','design_year_pvt_connection','base_year_water_demand','design_year_water_demand','treated_water_dicharge'];

   public function project()
   {
       return $this->belongsTo('App\Models\Projects','project_id');
   }

   public function projecttypes()
   {
       return $this->belongsTo('App\Models\ProjectType','project_type_id ');
   }

}


