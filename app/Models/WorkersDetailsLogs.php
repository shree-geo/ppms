<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkersDetailsLogs extends Model
{
    protected $fillable=['worker_details_id','user_id','status','status_date','comment'];
}
