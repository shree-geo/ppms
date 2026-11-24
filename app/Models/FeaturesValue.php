<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturesValue extends Model
{
    protected $fillable=['project_id','sailent_feature_id','before_value','after_value'];
}
