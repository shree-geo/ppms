<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['region_id', 'package_no', 'name', 'sector', 'reporting_fy_id', 'proj_start_fy_id', 'mou_signing_date', 'contract_amount', 'ded_approv_date', 'estimated_amount', 'contract_completion_date', 'financial_aggre_date', 'ded_pre_to_comm_date', 'bid_docu_date', 'ifb_pub_date', 'submission_date', 'aprro_contractor', 'contract_signing_date', 'completion_date_stage1', 'completion_date_stage2', 'dlp_date', 'survey_year', 'survey_total_household', 'survey_total_population', 'survey_family_size', 'base_year', 'base_total_household', 'base_total_population', 'design_year', 'design_total_household', 'design_total_population', 'aff_high_income', 'aff_avg_income', 'aff_low_income', 'aff_bpl_income', 'latest_eot', 'pbg_issued_date', 'pbg_expiry_date', 'apg_issued_date', 'apg_expiry_date', 'qc_plan', 'qc_plan_submitted', 'qc_calibiration_test', 'qc_calibiration_test_submitted', 'qc_third_party', 'qc_third_party_submitted','oba_contract_date','oba_contract_details','oba_file','latest_revised_contract_amount','latest_revised_cost_estimated','revised_stage2_date'];
    public function region()
    {
        return $this->belongsTo('App\Models\ProjectRegions');
    }

    public function reportingFY()
    {
        return $this->belongsTo('App\Models\Configurations\FiscalYear', 'reporting_fy_id');
    }
    public function projectStartFY()
    {
        return $this->belongsTo('App\Models\Configurations\FiscalYear', 'proj_start_fy_id');
    }

    public function address()
    {
        return $this->hasMany('App\Models\ProjectDistrict','project_id','id');
    }
    public function baseline()
    {
        return $this->hasMany('App\Models\BaseLines','project_id','id');
    }
    public function reservior()
    {
        return $this->hasMany('App\Models\ProjectReservoirs','project_id','id');
    }
}
