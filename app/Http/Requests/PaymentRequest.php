<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
            'payment.project_id'=> Rule::requiredIf( function () use ($user_group){
                                        return $user_group == 1 || $user_group==3;
                                    }),

            'payment.payment_date' => 'required',
            'payment.release_date' => 'required',
            'payment.type' => 'required',
            'payment.amount' => 'required|numeric|gt:0',

        ];
    }

    public function messages()
    {
        return [
            'payment.project_id.required'=>'Project name is required.',
            'payment.payment_date.required' => 'Payment Date is required.',
            'payment.release_date.required' => 'Release Date is required.',
            'payment.type.required' => 'Type is required.',
            'payment.amount.required' => 'Amount is required.',
            'payment.amount.numeric' => 'Payment Amount must be numeric.',
            'payment.amount.gt' => 'Payment Amount must be greater than 0.',

        ];
    }
}
