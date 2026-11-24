<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
  protected $fillable=['project_id','category','number','issue','reason','responsibility','action','status','participation','files','date'];

  public function project(){
    return $this->belongsTo('App\Models\Projects');
}
}