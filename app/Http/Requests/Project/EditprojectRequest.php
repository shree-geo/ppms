<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class EditprojectRequest extends FormRequest
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
            'project.package_no'=> 'required|unique:projects,package_no,' . \Request::segment(3),
            'project.name'=> 'required|unique:projects,name,' . \Request::segment(3),
            'project.sector'=> 'required',
            'project.reporting_fy_id'=> 'required',
            'project.proj_start_fy_id'=> 'required',
            'project.contract_amount'=> 'required|numeric|gt:0',
            'project.estimated_amount'=> 'nullable|numeric|gt:0',
            'project.contract_completion_date'=> 'required|date_format:Y-m-d',
            // 'project.ded_approv_date'=> 'required|date_format:Y-m-d',
            'project.ded_approv_date'=> 'required',
            'project.completion_date_stage1'=> 'required|date_format:Y-m-d',
            'project.completion_date_stage2'=> 'required|date_format:Y-m-d',
            'project.pbg_issued_date'=> 'required|date_format:Y-m-d',
            'project.pbg_expiry_date'=> 'required|date_format:Y-m-d',
            'project.apg_issued_date'=> 'required|date_format:Y-m-d',
            'project.apg_expiry_date'=> 'required|date_format:Y-m-d',
            'address.*.district_id'=>'required',
            'address.*.muni_id'=>'required',
            'address.*.ward_no'=>'required',
            'details.project_type_id'=>'required',
            'details.base_year_pvt_connection'=>'nullable|numeric',
            'details.design_year_water_demand'=>'nullable|numeric',
            'project.mou_signing_date'=> 'nullable|date_format:Y-m-d',
            'project.financial_aggre_date'=> 'nullable|date_format:Y-m-d',
            'project.ded_pre_to_comm_date'=> 'nullable|date_format:Y-m-d',
            'project.bid_docu_date'=> 'nullable|date_format:Y-m-d',
            'project.ifb_pub_date'=> 'nullable|date_format:Y-m-d',
            'project.submission_date'=> 'nullable|date_format:Y-m-d',
            'project.contract_signing_date'=> 'nullable|date_format:Y-m-d',
           
                    
        ];
        if(auth()->user()->user_group_id!=3){
            $rules['project.region_id']='required';

        }
        if(!\Request::has('buttonId')){
            $rules['sources.*.source_name']='required_if:project.sector,water_supply';
            $rules['sources.*.source_type']='required_if:project.sector,water_supply';
            $rules['sources.*.source_location']='required_if:project.sector,water_supply';
            $rules['sources.*.source_lat']='required_if:project.sector,water_supply';
            $rules['sources.*.source_lan']='required_if:project.sector,water_supply';
            $rules['sources.*.proposed_intake']='required_if:project.sector,water_supply';
            $rules['sources.*.discharge']='required_if:project.sector,water_supply';
            $rules['sources.*.remarks']='required_if:project.sector,water_supply';
            $rules['reservoirs.*.reservoir_name']='required_if:project.sector,water_supply';           
            $rules['reservoirs.*.capacity']='required_if:project.sector,water_supply';
            $rules['reservoirs.*.reservoir_location']='required_if:project.sector,water_supply';
            $rules['reservoirs.*.reservoir_lat']='required_if:project.sector,water_supply';
            $rules['reservoirs.*.reservoir_lang']='required_if:project.sector,water_supply';
            $rules['reservoirs.*.reservoirs_type']='required_if:project.sector,water_supply';
          
            $rules['details.base_year_pvt_connection']='required_if:project.sector,water_supply';
            $rules['details.design_year_pvt_connection']='required_if:project.sector,water_supply';
            $rules['details.base_year_water_demand']='required_if:project.sector,water_supply';
            $rules['details.design_year_water_demand']='required_if:project.sector,water_supply';
            $rules['details.existing_treatment_detail']='required_if:project.sector,water_supply';
            $rules['details.proposed_treatment_detail']='required_if:project.sector,water_supply';
            $rules['details.treated_water_dicharge']='required_if:project.sector,water_supply';
        }
        return $rules;
      
    }
    

    public function messages()
    {
        return [
            'project.package_no.required' => 'Package Number is required.',
            'project.package_no.unique' => 'Package Number already exist. Please provide another number.',
            'project.name.required' => 'Project Name is required.',
            'project.name.unique' => 'Project Name already exist. Please provide another name.',
            'project.reporting_fy_id.required' => 'Reporting Fiscal Year is required.',
            'project.proj_start_fy_id.required' => 'Project Start Fiscal Year is required.',
            'project.region_id.required' => 'Project region is required.',
            'project.sector.required' => 'Sector is required.',
            'project.contract_amount.required' => 'Contract Amount is required.',
            'contract_amount.numeric' => 'Contract Amount must be numeric.',
            'project.contract_amount.gt' => 'Contract Amount must be greater than 0.',
            'project.contract_completion_date.required' => 'Contract Completion Date is required.',
            'project.ded_approv_date.required' => 'DED Approve Date is required.',
            'project.completion_date_stage1.required' => 'Contract Completion Stage1 Date is required.',
            'project.completion_date_stage2.required' => 'Contract Completion Stage2 Date is required.',
            'project.pbg_issued_date.required' => 'PBG Issued Date is required.',
            'project.pbg_expiry_date.required' => 'PBG Expiry Date is required.',
            'project.apg_issued_date.required' => 'APG Issued Date is required.',
            'project.apg_expiry_date.required' => 'APG Expiry Date is required.',
            'address.*.district_id.required'=>'District is required',
            'address.*.muni_id.required'=>'Municipality is required',
            'address.*.ward_no.required'=>'Ward Number is required',

            //Sources
            'sources.*.source_name.required_if'=>'Source Name is required',
            'sources.*.source_type.required_if'=>'Source Type is required',
            'sources.*.source_location.required_if'=>'Source Location is required',
            'sources.*.source_lat.required_if'=>'Source Latitude is required',
            'sources.*.source_lan.required_if'=>'Source Longtitude is required',
            'sources.*.proposed_intake.required_if'=>'Proposed Intake is required',
            'sources.*.discharge.required_if'=>'Discharge is required',
            'sources.*.remarks.required_if'=>'Remarks is required',

            //Reserviors
            'reservoirs.*.reservoir_name.required_if'=>'Reservoir Name is required',
            'reservoirs.*.capacity.required_if'=>'Capacity is required',
            'reservoirs.*.reservoir_location.required_if'=>'Reservoir is required',
            'reservoirs.*.reservoir_lat.required_if'=>'Reservoir Latitude is required',
            'reservoirs.*.reservoir_lang.required_if'=>'Reservoir Longtitude is required',
            'reservoirs.*.reservoirs_type.required_if'=>'Reservoir Type is required',
            
            //details
            'details.project_type_id.required'=>'Project Type is required',
            'details.base_year_pvt_connection.required_if'=>'Base Year Pvt Connection is required',
            'details.design_year_pvt_connection.required_if'=>'Design Year Pvt Connection is required', 
            'details.base_year_pvt_connection.numeric'=>'Base Year Pvt Connection must be numeric value',
            'details.design_year_pvt_connection.numeric'=>'Design Year Pvt Connection must be numeric value',
            'details.base_year_water_demand.required_if'=>'Base Year Pvt Connection is  required',
            'details.design_year_water_demand.required_if'=>'Design Year Pvt Connection is required',
            'details.existing_treatment_detail.required_if'=>'Existing Treatment Detail is required',
            'details.proposed_treatment_detail.required_if'=>'Proposed Treatment Detail is required',
            'details.treated_water_dicharge.required_if'=>"Water Discharge is Required",
           
            
        ];
    }
}
