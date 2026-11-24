<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table='revision';
    protected $fillable=['rname','project_id','created_by_user_id','revision_remarks','created_date'];
}
