<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institutional extends Model
{
   protected $fillable = ['project_id', 'institution_name', 'institution_type', 'total_female', 'total_male','status','status_date'];

   public function project()
   {
      return $this->belongsTo('App\Models\Projects');
   }
}
