<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class OfficeTypeRequest extends FormRequest
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
            'office_type_name'=>'required|string|not_regex:/^[0-9]*$/|unique:office_types,office_type_name,'.\Request::segment(3),
        ];
    }

    public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'office_type_name.required' => 'Office Type Name is required. Please provide office type name.',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
