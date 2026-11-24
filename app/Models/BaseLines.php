<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseLines extends Model
{
    protected $fillable=['project_id','base_line_type','private_conn','public_tap','source','average_time','per_capita','quality','public_toilet','water_seal','vip','pit_latrine','none'];
}
