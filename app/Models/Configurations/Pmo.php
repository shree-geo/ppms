<?php

namespace App\Models\Configurations;

use Illuminate\Database\Eloquent\Model;

class Pmo extends Model
{
    protected $fillable = ['project_num', 'loan_num', 'loan_aggre_date', 'loan_amount', 'interest_rate', 'loan_effective_date', 'loan_closing_date'];
}
