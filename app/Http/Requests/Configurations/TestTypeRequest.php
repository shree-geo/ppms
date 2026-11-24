<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class TestTypeRequest extends FormRequest
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
            'test_name' => 'required|string|not_regex:/^[0-9]*$/'
            // 'test_name' => 'required|string|not_regex:/^[0-9]*$/|unique:test_types,test_name,' . \Request::segment(3)
        ];
    }

    public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'test_name.required' => 'Test Type name is required.Please provide Test Type name',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
