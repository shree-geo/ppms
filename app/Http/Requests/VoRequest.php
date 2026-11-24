<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class VoRequest extends FormRequest
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

            'vo.variation_amount' => 'required|numeric',
            'vo.revised_cost_estimated' => 'required|numeric',
            'vo.revised_contract_amount' => 'required|numeric',
            'vo.approved_date' => 'required',
            'vo.approved_by' => 'required',
            'vo.variation_per' => 'required',
            'vo.serial_no' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
            'vo.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),

           
        ];
    }

    public function messages()
    {
        return [

            'vo.variation_amount.required' => 'Variation Amount is required.',
            'vo.variation_amount.numeric' => 'Variation Amount must be numeric.',
            'vo.variation_amount.gt' => 'Variation Amount must be greater than 0 .',
            'vo.revised_cost_estimated.required' => 'Revised Cost Estimated is required.',
            'vo.revised_cost_estimated.numeric' => 'Revised Cost Estimated must be numeric.',
            'vo.revised_cost_estimated.gt' => 'Revised Cost Estimated must be greater than 0 .',
            'vo.revised_contract_amount.required' => 'Revised Contract Amount is required.',
            'vo.revised_contract_amount.numeric' => 'Revised Contract Amount must be numeric.',
            'vo.revised_contract_amount.gt' => 'Revised Contract Amount must be greater than 0.',
            'vo.remarks.required' => 'Remarks is required.',
            'vo.approved_date.required' => 'Approved Date is required.',
            'vo.approved_by.required' => 'Approved By is required.',
            'vo.variation_per.required' => 'Variation Percentage is required.',
            'vo.serial_no.required' => 'Serial Number is required.',
            'file.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            'vo.project_id.required'=>'Project Name is required.'

           
        ];
    }
}
