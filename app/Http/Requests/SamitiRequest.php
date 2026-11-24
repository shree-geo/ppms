<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SamitiRequest extends FormRequest
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
            // 'project_id' => 'required',
            'samiti_year' => 'required',
            // 'position_id' => 'required',
            // 'member_gender' => 'required',
            // 'member_cast_id' => 'required',
            // 'member_name' => 'required|unique:samitis,member_name,' .\Request::segment(3),
            'members.*.member_name' => 'required_with:members.*.member_name,',
            'project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),
           
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'Project Name is required.',
            'samiti_year.required' => 'Samiti Year is required.',
            'position_id.required' => 'Position is required.',
            'member_gender.required' => 'Gender is required.',
            'member_cast_id.required' => 'cast is required.',
            'member_name.required' => 'Name is required.',
            'member_name.unique' => 'Name already exist. Please provide another name.',
        
        ];
    }
}
