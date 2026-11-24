<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable=['project_id', 'date', 'type', 'leadBy', 'participant', 'no_of_participant', 'social_observation', 'social_suggestion', 'social_improvement','technical_observation',
    'technical_suggestion','technical_improvement','env_observation','env_suggestion','env_improvement','gesi_observation','gesi_suggestion','gesi_improvement','file'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}


