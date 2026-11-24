<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
        return [
            'office_code'=>'required|unique:offices,office_code,'.\Request::segment(3),
            'district_id'=>'required',
            'office_name'=>'required|string|not_regex:/^[0-9]*$/|unique:offices,office_name,'.\Request::segment(3),
            'office_type_id'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'office_code.required' => 'Office code is required. Please provide office code.',
            'district_id.required' => 'District Name is required. Please provide district name.',
            'office_type_id.required' => 'Office Type is required. Please provide office type.',
            'office_name.required' => 'Office Name is required. Please provide office name.',
            'unique' => 'Name already exist. Please provide another name.',
            'office_code.unique' => 'Code already exist. Please provide another code.'
        ];
    }
}
