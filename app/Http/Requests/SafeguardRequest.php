<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SafeguardRequest extends FormRequest
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
               'ddr_status'=>'required',
               'ddr_date'=>'required',
               'ir_status'=>'required',
               'ir_date'=>'nullable|date_format:Y-m-d',
               'ipp_status'=>'required',
               'ipp_date'=>'nullable|date_format:Y-m-d',
           
        ];
    }

    public function messages()
    {
        return [
           
            'project_id.required'=>'Project Name is required.',
            'ddr_status.required'=>'DDR status is required.',
            'ddr_date.required'=>'DDR date is required.',
            'ddr_date.date_format'=>'Date Format not Matched.',

            'ir_status.required'=>'IR status is required.',
            'ir_date.required'=>'IR date is required.',
            'ir_date.date_format'=>'Date Format not Matched.',

            'ipp_status.required'=>'IPP status is required.',
            'ipp_date.required'=>'IPP date is required.',
            'ipp_date.date_format'=>'Date Format not Matched.',

           
        ];
    }
}
