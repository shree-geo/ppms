<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ReportUploadRequest extends FormRequest
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

            'year' => 'required',
            'months' => 'required',
            'title' => 'required',
            'type' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:20480',
            'project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),

        ];
    }

    public function messages()
    {
        return [

            'year.required' => 'Year is required.',
            'months.required' => 'Month is required.',
            'file.required' => 'Document is required.',
            'title.required' => 'Title is required.',
            'project_id.required'=>'Project Name is required.',
            'max'=>'File must not be greater than 20 MB',


        ];
    }
}
