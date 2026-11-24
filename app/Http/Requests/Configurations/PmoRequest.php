<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class PmoRequest extends FormRequest
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
        return [
            'project_num' => 'required',
            'loan_num' => 'required',
            'loan_aggre_date' => 'required',
            'loan_amount' => 'required|numeric|gt:0',
            'interest_rate' => 'required',
            'loan_effective_date' => 'required',
            'loan_closing_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'project_num.required' => 'Project number is reuired.',
            'loan_num.required' => 'Loan number is required.',
            'loan_aggre_date.required' => 'Loan aggrement date is required.',
            'loan_amount.required' => 'Loan amount is required.',
            'interest_rate.required' => 'Interest rate is required.',
            'loan_effective_date.required' => 'Loan effective date is required.',
            'loan_closing_date.required' => 'Loan closing date is required.'
        ];
    }
}
