<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrievanceCommunity extends Model
{
    protected $fillable = ['project_id', 'level', 'name', 'designation', 'contact_no', 'email'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
