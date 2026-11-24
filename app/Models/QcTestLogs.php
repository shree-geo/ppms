<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcTestLogs extends Model
{
    protected $fillable=['qc_test_id','user_id','status','status_date','comment'];
}
