<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class DocumentCategoryRequest extends FormRequest
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
            'cat_name'=> 'required|string|not_regex:/^[0-9]*$/|unique:document_catgories,cat_name,'.\Request::segment(3)
        ];
    }

   public function messages()
    {
        return [
            'not_regex' => 'Numeric value provided. Please provide another name.',
            'cat_name.required' => 'Category Name is required. Please provide country name.',
            'unique' => 'Name already exist. Please provide another name.'
        ];
    }
}
