<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oba extends Model
{
    protected $fillable = ['project_id', 'oba_types_id', 'dis_id', 'year', 'months', 'total', 'remarks','status','status_date'];
    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
    public function obaTypes()
    {
        return $this->belongsTo('App\Models\ObaTypes');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\Configurations\District', 'dis_id');
    }
    public function details()
    {
        return $this->hasMany('App\Models\ObaDetails','obas_id');
    }
}
