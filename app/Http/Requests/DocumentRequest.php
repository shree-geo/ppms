<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class DocumentRequest extends FormRequest
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

            'doc.cat_id' => 'required',
            'doc.doc_title' => 'required',
            'doc.signed_date' => 'required|date_format:Y-m-d',
            'doc.approved_date' => 'required|date_format:Y-m-d',
            'doc.clearance_date' => 'required|date_format:Y-m-d',
            // 'doc.file' => 'required|image:jpeg,png,jpg',
            'doc.file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:20480',

            'doc.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),

        ];
    }

    public function messages()
    {
        return [

            'doc.cat_id.required' => 'Document Category is required.',
            'doc.doc_title.required' => 'Title is required.',
            'doc.file.required' => 'Document is required.',
            'doc.signed_date.required' => 'Signed Date is required.',
            'doc.signed_date.date_format' => 'Date Format not match.',
            'doc.approved_date.required' => 'Approved Date is required.',
            'doc.approved_date.date_format' => 'Date Format not match.',
            'doc.clearance_date.required' => 'Clearance Date is required.',
            'doc.clearance_date.date_format' => 'Date Format not match.',
            'doc.project_id.required'=>'Project Name is required.',
            'doc.file.max' => 'Sorry! Maximum allowed size for an image is 20MB',

        ];
    }
}
