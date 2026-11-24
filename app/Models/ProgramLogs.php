<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramLogs extends Model
{
   protected $fillable=['program_id','user_id','status','status_date','comment'];
}
