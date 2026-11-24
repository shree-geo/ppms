<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObaLogs extends Model
{
    protected $fillable=['oba_id','user_id','status','status_date','comment'];
}
