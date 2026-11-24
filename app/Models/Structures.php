<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structures extends Model
{
    protected $fillable=['sector_name','parent_id','structure_name','unit_id','location'];

    public function unit(){
        return $this->belongsTo('App\Models\Units');
    }

    public function parent(){
        return $this->belongsTo('App\Models\Structures');
    }
}
