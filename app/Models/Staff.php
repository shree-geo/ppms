<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable=['project_id','ofc_name','department','name','designaion_id','gender','contact_no','email','join_date','end_date','status'];

    public function project(){
        return $this->belongsTo('App\Models\Projects');
    }
    public function designation(){
        return $this->belongsTo('App\Models\Configurations\Designation','designaion_id');
    }
}


