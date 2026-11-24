<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSourceDetails extends Model
{
    protected $fillable=['source_name','project_id','source_type','source_location','source_lat','source_lan','proposed_intake','discharge','remarks'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
