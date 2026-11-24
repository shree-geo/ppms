<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStructures extends Model
{
   protected $fillable=['project_id','structure_id','estimation'];

   public function project(){
       return $this->belongsTo('App\Models\Projects');
   }

   public function structure(){
       return $this->belongsTo('App\Models\Structures');
   }
}
