<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDistrict extends Model
{
  protected $fillable=['project_id','district_id','muni_id','ward_no'];

     public function district(){
        return $this->belongsTo('App\Models\Configurations\District');
    }
    public function municipality(){
        return $this->belongsTo('App\Models\Configurations\Municipality','muni_id');
    }

      public function project()
    {
        return $this->belongsTo('App\Models\Projects','project_id');
    }
}
