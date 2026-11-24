<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProgressDataRequest extends FormRequest
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
        $user_group=auth()->user()->user_group_id;
        return [
            
            'project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),
            'initial_target.*.*'=>'nullable|numeric',
            'progress.*.*'=>'nullable|numeric',
            'financial.*.*'=>'nullable|numeric',
            'dispercement.*.*'=>'nullable|numeric',
            
           
        ];
    }
    public function messages()
    {
        return [
            'project_id.required' => 'Project Name is required.',
            'initial_target.*.*.numeric'=>'Target Must be numeric',
            'progress.*.*.numeric'=>'Progress Must be numeric',
            'financial.*.*.numeric'=>'Financial Progress must be numeric',
            'dispercement.*.*.numeric'=>'Dispercement must be numeric',
            
        
        ];
    }
}
