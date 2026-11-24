<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
            'staff.project_id'=> Rule::requiredIf( function () use ($user_group){
                return $user_group == 1 || $user_group==3;
            }),
            'staff.ofc_name'=>'required',
            'staff.department'=>'required',
            'staff.name'=>'required',
            'staff.designaion_id'=>'required',
            'staff.gender'=>'required',
            'staff.contact_no'=>'nullable|numeric',
            'staff.email'=>'nullable|email',
            'staff.join_date'=>'required|date_format:Y-m-d',
            'staff.end_date'=>'nullable|date_format:Y-m-d',
            'staff.status'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'staff.project_id.required'=>'Project Name is required.',
            'staff.ofc_name.required'=>'Office Name is required',
            'staff.department.required'=>'Department required',
            'staff.name.required'=>'Name required',
            'staff.designaion_id.required'=>'Desigantaion required',
            'staff.gender.required'=>'Gender is required',
            'staff.contact_no.required'=>'Conatct is required',
            'staff.contact_no.numeric'=>'Conatct Number must be numeric',
            'staff.email.required'=>'Email is required',
            'staff.join_date.required'=>'Join Date is required',
            'staff.end_date.required'=>'End Date is required',
            'staff.join_date.date_format'=>'Date Format not match.',
            'staff.end_date.date_format'=>'Date Format not match.',
            'staff.status.required'=>'Status is required',
        ];
    }
}
