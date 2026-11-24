<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    protected $fillable = ['project_id', 'program_type_id', 'program_title', 'program_details', 'program_files', 'start_date', 'end_date', 'bramin_f', 'bramin_m', 'dalit_f', 'dalit_m', 'janjati_f', 'janjati_m', 'others_f', 'others_m', 'muslim_f', 'muslim_m','status','status_date','file'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
    public function programType()
    {
        return $this->belongsTo('App\Models\ProgramTypes');
    }
}
