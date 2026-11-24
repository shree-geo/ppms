<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class ObaTypesRequest extends FormRequest
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
            'oba_type_name'=>'required|string|not_regex:/^[0-9]*$/|unique:oba_types,oba_type_name,'.\Request::segment(3)
        ];
    }

   public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'oba_type_name.required' => ' Name is required. Please provide  name.',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
