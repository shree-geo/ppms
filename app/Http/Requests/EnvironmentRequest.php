<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class EnvironmentRequest extends FormRequest
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
        $user_group= auth()->user()->user_group_id;
        return [
            'project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
           'emp_ssemp_prepared'=>'required',
           'focal_person'=>'required',
           'safe_statutory_clearance'=>'required',
           'safe_envi_clearance'=>'required',
           'safe_site_clearance'=>'required',
           'safe_tree_cutting'=>'required',
           'safe_no_objection'=>'required',
           'safe_construct_permit'=>'required',
           'safe_operate_permit'=>'required',
           'safe_road_cutting_permit'=>'required',
           'safe_utility_shifting_permit'=>'required',

           'adb_report_disclosed_date'=>'nullable|date_format:Y-m-d', 
           'adb_final_approval_date'=>'nullable|date_format:Y-m-d', 
           'gon_tor_approval_date'=>'nullable|date_format:Y-m-d',
           'gon_approval_iee_date'=>'nullable|date_format:Y-m-d',
           'safe_mou_file'=>'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
           'gon_tor_approval_file'=>'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
           'gon_iee_file'=>'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
           'adb_approval_file'=>'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
        ];
    }

    public function messages()
    {
        return [
           
            'project_id.required'=>'Project Name is required.',
            'emp_ssemp_prepared.required'=>'This field is required.',
            'focal_person.required'=>'This field is required.',
            'safe_statutory_clearance.required'=>'This field is required.',
            'safe_envi_clearance.required'=>'This field is required.',
            'safe_site_clearance.required'=>'This field is required.',
            'safe_tree_cutting.required'=>'This field is required.',
            'safe_no_objection.required'=>'This field is required.',
            'safe_construct_permit.required'=>'This field is required.',
            'safe_operate_permit.required'=>'This field is required.',
            'safe_road_cutting_permit.required'=>'This field is required.',
            'safe_utility_shifting_permit.required'=>'This field is required.',
            'adb_report_submi_date.date_format'=>'Date Format not match.',
            'adb_report_disclosed_date.date_format'=>'Date Format not match.',
            'adb_revised_iee_date.date_format'=>'Date Format not match.',
            'adb_final_approval_date.date_format'=>'Date Format not match.',
            'gon_tor_approval_date.date_format'=>'Date Format not match.',
            'gon_draft_iee_date.date_format'=>'Date Format not match.',
            'gon_presen_iee_date.date_format'=>'Date Format not match.',
            'gon_final_iee_date.date_format'=>'Date Format not match.',
            'gon_approval_iee_date.date_format'=>'Date Format not match.',
            'max'=>'File must not be greater than 20 MB',

           
        ];
    }
}
