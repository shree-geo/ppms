<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryLogs extends Model
{
    protected $fillable=['beneficiary_id','user_id','status','status_date','comment'];
}
