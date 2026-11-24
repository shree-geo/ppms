<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $table='test_types';
    protected $fillable = ['test_name','material_id'];

    public function materials(){
        return $this->belongsTo('App\Models\Materials','material_id','id');
    }
}
