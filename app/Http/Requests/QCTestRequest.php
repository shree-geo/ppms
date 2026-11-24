<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QCTestRequest extends FormRequest
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
            'qcTest.test_type_id' => 'required',
            'qcTest.material_id' => 'required',
            'qcTest.followed_code' => 'required',
            'qcTest.test_date' => 'required|date_format:Y-m-d',
            'qcTest.test_location' => 'required',
            'qcTest.result' => 'required',
            'qcTest.test_by' => 'required',
            // 'qcTest.remarks' => 'required',
            'qcTest.year'=>'required',
            'qcTest.month'=>'required',
            'qcTest.obaserved_result'=>'required',
            'qcTest.output_result'=>'required',
            'qcTest.project_id' => Rule::requiredIf(function () use ($user_group) {
                return $user_group == 1 || $user_group == 3;
            }),
           'report_file.*'=>'nullable|mimes:jpg,jpeg,png,pdf|max:20480',

        ];
    }

    public function messages()
    {
        return [
            'qcTest.test_type_id.required' => 'Test Type is required.',
            'qcTest.material_id.required' => 'Material is required.',
            'qcTest.followed_code.required' => 'Code Followed is required.',
            'qcTest.test_date.required' => 'Test Date is required.',
            'qcTest.test_date.date_format' => 'Date Format not match.',
            'qcTest.test_location.required' => 'Test Location is required.',
            'qcTest.result.required' => 'Test Result is required.',
            'qcTest.test_by.required' => 'Tested By is required.',
            'qcTest.project_id.required' => 'Project Name is required.',
            // 'qcTest.remarks.required' => 'Remarks is required.',
            'qcTest.year.required'=>'Year is required',
            'qcTest.month.required'=>'Month is required',
            'qcTest.obaserved_result.required'=>'Observed Result is required',
            'max'=>'File must not be greater than 20 MB',


        ];
    }
}
