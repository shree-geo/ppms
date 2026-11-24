<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class GrievanceRequest extends FormRequest
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
            'project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
               'issue'=>'required',
               'complain_by'=>'required',
               'complain_date'=>'required|date_format:Y-m-d',
               'affected_site'=>'required',
               'complain_source'=>'required',
               'grievance_level'=>'required',
               'file.*'=>'nullable|mimes:png,jpg,pdf|max:20480',
           
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            'project_id.required'=>'Project Name is required.',
            'issue.required'=>'Issue is required.',
            'complain_by.required'=>'Complain By is required.',
            'complain_date.required'=>'Complain Date is required.',
            'complain_date.date_format'=>'Date Format not Match.',
            'affected_site.required'=>'Affected Site is required.',
            'complain_source.required'=>'Complain Source is required.',
            'grievance_level.required'=>'Grievance Level is required.',
           
        ];
    }
}
