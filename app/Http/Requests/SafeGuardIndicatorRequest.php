<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SafeGuardIndicatorRequest extends FormRequest
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
            'saf.indicator_name' => 'required',
            'saf.project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
               'saf.indicator_value'=>'required',
               'file.*'=>'required|mimes:png,jpg,pdf|max:20480',
            //    'saf.remarks'=>'required',
        ];
    }
    public function messages()
    {
        return [
           
            'saf.indicator_name.required' => 'Indicator Name is required.',
            'saf.project_id.required'=>'Project Name is required.',
            'sad.indicator_value.required'=>'indicator Value is required.',
            'file.*.required'=>'File is required.',
            'file.*.max'=>'File must not be greater than 20 MB',
            'saf.remarks.required'=>'Remarks is required.',            
           
        ];
    }
}
