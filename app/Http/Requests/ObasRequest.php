<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ObasRequest extends FormRequest
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

            'obas.oba_types_id' => 'required',
            'obas.dis_id' => 'required',
            'obas.year' => 'required',
            'obas.months' => 'required',
            'obas.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),
            'details.*.owner_name'=>'required',
            'details.*.family_size'=>'required|integer|min:0',
            'details.*.male_count'=>'required|integer|min:0',
            'details.*.female_count'=>'required|integer|min:0',

        ];
    }

    public function messages()
    {
        return [

            'obas.oba_types_id.required' => 'OBA Type is required',
            'obas.dis_id.required' => ' District is required',
            'obas.year.required' => 'Year is required',
            'obas.months.required' => 'Month is required',
            'obas.total.reqquired' => 'Total is reuired',
            'obas.project_id.required'=>'Project Name is required.',
              'details.*.owner_name.required'=>'Owner Name is required',
            'details.*.family_size.required'=>'Family Size is required',
            'details.*.male_count.required'=>'Male Count is required',
            'details.*.female_count.required'=>'Female Count is required',

        ];
    }
}
