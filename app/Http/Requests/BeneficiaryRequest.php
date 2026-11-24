<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class BeneficiaryRequest extends FormRequest
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
            'ben.beneficiary_sector' => 'required',
            'ben.project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
           
        ];
    }

    public function messages()
    {
        return [
           
            'ben.beneficiary_sector.required' => 'Beneficiary Type is required.',
            'ben.project_id.required'=>'Project Name is required.',
           
        ];
    }
}
