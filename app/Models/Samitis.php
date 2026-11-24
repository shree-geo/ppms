<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Samitis extends Model
{
    protected $fillable=['project_id','samiti_year','position_id','member_name','member_gender','member_cast_id','excluded_group'];
    
    public function project(){
        return $this->belongsTo('App\Models\Projects');

    }


}
