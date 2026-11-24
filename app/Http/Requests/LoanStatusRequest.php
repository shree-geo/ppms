<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanStatusRequest extends FormRequest
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

            'loan.loan_aggre_date' => 'required',
            'loan.loan_amount' => 'required',
            'loan.interest_rate' => 'required',
            'loan.loan_effective_date' => 'required',
            'loan.loan_closing_date' => 'required',
           
        ];
    }

    public function messages()
    {
        return [

            'loan.loan_aggre_date.required' => 'Loan Aggrement Date is required.',
            'loan.loan_amount.required' => 'Loan Amount is required.',
            'loan.interest_rate.required' => 'Interest Rate is required.',
            'loan.loan_effective_date.required' => 'Loan Effective Date is required.',
            'loan.loan_closing_date.required' => 'Loan Closing Date is required.',
           
        ];
    }
}
