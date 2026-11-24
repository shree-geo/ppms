<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [
            // 'region_id'=>'required',
            'package_no'=> 'required|unique:projects,package_no,' . \Request::segment(3),
            'name'=>'required|unique:projects,name,' . \Request::segment(3),
            'sector'=> 'required',
            'reporting_fy_id'=> 'required',
            'proj_start_fy_id'=> 'required',
            'contract_amount'=> 'required|numeric|gt:0',
            'estimated_amount'=> 'nullable|numeric|gt:0',
            'contract_completion_date'=> 'required|date_format:Y-m-d',
            // 'ded_approv_date'=> 'required|date_format:Y-m-d',
            'ded_approv_date'=> 'required',
            'completion_date_stage1'=> 'required|date_format:Y-m-d',
            'completion_date_stage2'=> 'required|date_format:Y-m-d',
            'pbg_issued_date'=> 'required|date_format:Y-m-d',
            'pbg_expiry_date'=> 'required|date_format:Y-m-d',
            'apg_issued_date'=> 'required|date_format:Y-m-d',
            'apg_expiry_date'=> 'required|date_format:Y-m-d',
            'address.*.district_id'=>'required',
            'address.*.muni_id'=>'required',
            'address.*.ward_no'=>'required',     
            'mou_signing_date'=> 'nullable|date_format:Y-m-d',
            'financial_aggre_date'=> 'nullable|date_format:Y-m-d',
            'ded_pre_to_comm_date'=> 'nullable|date_format:Y-m-d',
            'bid_docu_date'=> 'nullable|date_format:Y-m-d',
            'ifb_pub_date'=> 'nullable|date_format:Y-m-d',
            'submission_date'=> 'nullable|date_format:Y-m-d',
            'contract_signing_date'=> 'nullable|date_format:Y-m-d',

        ];

        if(auth()->user()->user_group_id!=3){
            $rules['region_id']='required';

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'package_no.required' => 'Package Number is required.',
            'package_no.unique' => 'Package Number already exist. Please provide another number.',
            'name.required' => 'Project Name is required.',
            'name.unique' => 'Project Name already exist. Please provide another name.',
            'reporting_fy_id.required' => 'Reporting Fiscal Year is required.',
            'proj_start_fy_id.required' => 'Project Start Fiscal Year is required.',
            'region_id.required' => 'Project region is required.',
            'sector.required' => 'Sector is required.',
            'contract_amount.required' => 'Contract Amount is required.',
            'contract_amount.numeric' => 'Contract Amount must be numeric.',
            'contract_amount.gt' => 'Contract Amount must be greater than 0.',
            'contract_completion_date.required' => 'Contract Completion Date is required.',
            'ded_approv_date.required' => 'DED Approve Date is required.',
            'completion_date_stage1.required' => 'Contract Completion Stage1 Date is required.',
            'completion_date_stage2.required' => 'Contract Completion Stage2 Date is required.',
            'pbg_issued_date.required' => 'PBG Issued Date is required.',
            'pbg_expiry_date.required' => 'PBG Expiry Date is required.',
            'apg_issued_date.required' => 'APG Issued Date is required.',
            'apg_expiry_date.required' => 'APG Expiry Date is required.',
             'address.*.district_id.required'=>'District is required',
            'address.*.muni_id.required'=>'Municipality is required',
            'address.*.ward_no.required'=>'Ward Number is required',            
        ];
    }
}
