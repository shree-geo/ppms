<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable=['project_id','beneficiary_sector','dalit_f','dalit_m','janjati_f','janjati_m','bramin_f','bramin_m','other_f','other_m','muslim_f','muslim_m','status','status_date','dalit_hh','janjati_hh','bramin_hh','other_hh','muslim_hh'];

    
    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
