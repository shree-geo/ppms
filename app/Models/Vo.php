<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vo extends Model
{
    protected $fillable=['project_id','serial_no','variation_per','revised_cost_estimated','revised_contract_amount','variation_amount','approved_date','approved_by','file','remarks'];
    public function project()
    {
        return $this->belongsTo('App\Models\Projects');
    }
}
