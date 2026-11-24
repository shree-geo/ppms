<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QualityControlRequest extends FormRequest
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
            'qc_type_id' => 'required',
            'target' => 'required',
            'project_id' => Rule::requiredIf(function () use ($user_group) {
                return $user_group == 1 || $user_group == 3;
            }),

        ];
    }

    public function messages()
    {
        return [
            'qc_type_id.required' => 'Quality Control Type is required.',
            'target.required' => 'Quality Control Target is required.',
            'project_id.required' => 'Project Name is required.',
        ];
    }
}
