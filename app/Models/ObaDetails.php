<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObaDetails extends Model
{
    protected $fillable=['obas_id','owner_name','casts_id','family_size','househead_women','female_count','male_count','oba_status','start_date','complete_date','inuse_date'];
    
}
