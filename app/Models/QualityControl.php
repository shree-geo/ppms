<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityControl extends Model
{
    protected $fillable = ['project_id', 'qc_type_id', 'target'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }

    public function qcType()
    {
        return $this->belongsTo('App\Models\QCType');
    }
}
