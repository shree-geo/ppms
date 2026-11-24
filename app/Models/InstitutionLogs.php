<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionLogs extends Model
{
    protected $fillable=['institution_id','user_id','status','status_date','comment'];
}
