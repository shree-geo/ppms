<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class GrievanceCommitteEditRequest extends FormRequest
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
            'grievanceCommitte.name' => 'required',
            'grievanceCommitte.designation' => 'required',
            'grievanceCommitte.email' => 'nullable|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'grievanceCommitte.project_id' => Rule::requiredIf(function () use ($user_group) {
                return $user_group == 1 || $user_group == 3;
            }),

        ];
    }

    public function messages()
    {
        return [
            'grievanceCommitte.name.required' => 'Name is required.',
            'grievanceCommitte.designation_id.required' => 'Designation is required.',
            'grievanceCommitte.contact_no.required' => 'Contact no. is required.',
            'grievanceCommitte.email.required' => 'Email is required.',
            'grievanceCommitte.forwarded_date.required' => 'Forwarded Date is required.',
            'grievanceCommitte.forwarded_date.date_format' => 'Date Format not Matched.',
            'grievanceCommitte.project_id.required' => 'Project Name is required.',
        ];
    }
}
