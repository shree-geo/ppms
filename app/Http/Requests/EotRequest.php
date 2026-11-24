<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class EotRequest extends FormRequest
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
            'file' => 'mimes:jpg,jpeg,png,pdf|max:20480',
            'eot.project_id'=>Rule::requiredIf(function() use ($user_group){
                    return $user_group==1 || $user_group==3;
            }),
            'eot.revised_stage1_completion_date'=>'required|date_format:Y-m-d',
            'eot.revised_stage2_completion_date'=>'required|date_format:Y-m-d',
            'eot.serial_no'=>'required',
            'eot.extended_by'=>'required',
            'eot.approved_by'=>'required',
            'eot.approved_date'=>'required|date_format:Y-m-d',
           
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            'eot.project_id.required'=>'Project Name is required.',

            'eot.revised_stage1_completion_date.required'=>'Revised stage1 completion is required.',
            'eot.revised_stage2_completion_date.required'=>'Revised stage2 completion is required.',
            'eot.approved_date.required'=>'Date  is required.',
            'eot.approved_date.date_format'=>'Date must be in Y-m-d Format .',
            'eot.serial_no.required'=>'Serial Number is required.',
            'eot.extended_by.required'=>'Extended By is required.',
            'eot.approved_by.required'=>'Approved By is required.',

           
        ];
    }
}
