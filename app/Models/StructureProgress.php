<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructureProgress extends Model
{
  protected $fillable=['project_id','structure_id','year','month','target','progress','status','status_date','target_for_next_month'];

  public function project(){
    return $this->belongsTo('App\Models\Projects');
  }
}
