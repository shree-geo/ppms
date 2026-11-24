<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    protected $fillable=['project_id', 'loan_aggre_date', 'loan_amount', 'interest_rate', 'loan_effective_date', 'loan_closing_date'];

    public function project(){
        return $this->belongsTo('App\Models\Projects');
    }
}
