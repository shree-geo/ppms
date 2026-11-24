<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafeguardIndicator extends Model
{
    protected $fillable=['project_id','indicator_name','indicator_value','file','remarks'];

    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
