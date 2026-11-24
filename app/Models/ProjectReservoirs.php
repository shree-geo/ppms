<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectReservoirs extends Model
{
    protected $fillable=['project_id','reservoir_name','capacity','reservoir_location','reservoir_lat','reservoir_lang','reservoirs_type'];
    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
