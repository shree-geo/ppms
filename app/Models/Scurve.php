<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scurve extends Model
{
    protected $table='scurve';
    protected $fillable=['project_id','revision_name','year','month','month_code','target','progress','financial_progress','dispercement','data_value'];
}
