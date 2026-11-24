<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'material_name' => 'required|string|not_regex:/^[0-9]*$/|unique:materials,material_name,' . \Request::segment(3)
        ];
    }

    public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'material_name.required' => 'Material name is required.Please provide Material name',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
