<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class InstitutionalRequest extends FormRequest
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

            'insti.institution_type' => 'required',
            'insti.institution_name' => 'required',
            'insti.total_female' => 'required|integer|min:0',
            'insti.total_male' => 'required|integer|min:0',
            'insti.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),

        ];
    }

    public function messages()
    {
        return [

            'insti.institution_type.required' => 'Institutional Type is required.',
            'insti.institution_name.required' => 'Institutional Name is required.',
            'insti.total_female.required' => 'Female Count is required.',
            'insti.total_female.integer' => 'Female Count must be integer.',
            'insti.total_male.required' => 'Male Count is required.',
            'insti.total_male.integer' => 'Male Count must be integer.',
            'insti.project_id.required'=>'Project Name is required.',

        ];
    }
}
