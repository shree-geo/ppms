<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'country_name'=>'required|string|not_regex:/^[0-9]*$/|unique:countries,country_name,'.\Request::segment(3)
        ];
    }

   public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'country_name.required' => 'Country Name is required. Please provide country name.',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
