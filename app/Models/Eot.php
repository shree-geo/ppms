<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eot extends Model
{
   protected $fillable=['project_id',
   'revised_stage1_completion_date',
   'revised_stage2_completion_date',
   'serial_no', 
   'extended_by',
   'approved_date',
   'approved_by',
    'remarks',
    'file'];

   public function project()
   {
      return $this->belongsTo('App\Models\Projects');
   }
}
