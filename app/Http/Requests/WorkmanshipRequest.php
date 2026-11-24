<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class WorkmanshipRequest extends FormRequest
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
            'project.project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
               'project.aff_high_income'=>'nullable|numeric',
               'project.aff_avg_income'=>'nullable|numeric',
               'project.aff_low_income'=>'nullable|numeric',
               'project.aff_bpl_income'=>'nullable|numeric',
               'project.survey_family_size'=>'nullable|numeric',
           
        ];
    }

    public function messages()
    {
        return [
           
            'project.project_id.required'=>'Project Name is required.',
           
        ];
    }
}
