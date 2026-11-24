<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvMonthlyLogs extends Model
{
    protected $fillable=['env_monthly_id','user_id','status','status_date','comment'];
}
