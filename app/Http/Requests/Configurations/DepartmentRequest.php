<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_name'=>'required|string|not_regex:/^[0-9]*$/|unique:departments,department_name,'.\Request::segment(3)
        ];
    }

    public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'department_name.required'=>'Department name is required.Please provide department name',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
