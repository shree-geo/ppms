<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ThirdLevelGrievanceRequest extends FormRequest
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
        $user_group = auth()->user()->user_group_id;
        return [
            'grievanceThirdLevel.name' => 'required',
            'grievanceThirdLevel.designation' => 'required',
            // 'grievanceThirdLevel.contact_no' => 'nullable|required',
            'grievanceThirdLevel.email' => 'nullable|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            // 'grievanceThirdLevel.forwarded_date' => 'required|date_format:Y-m-d',
           

        ];
    }

    public function messages()
    {
        return [
            'grievanceThirdLevel.name.required' => 'Name is required.',
            'grievanceThirdLevel.designation.required' => 'Designation is required.',
            'grievanceThirdLevel.contact_no.required' => 'Contact no. is required.',
            'grievanceThirdLevel.email.required' => 'Email is required.',
            'grievanceThirdLevel.forwarded_date.required' => 'Forwarded Date is required.',
            'grievanceThirdLevel.forwarded_date.date_format' => 'Date Format not Matched.',
            'grievanceThirdLevel.project_id.required' => 'Project Name is required.',
        ];
    }
}
