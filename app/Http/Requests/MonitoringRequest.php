<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class MonitoringRequest extends FormRequest
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
           
            'moni.date' => 'required|date_format:Y-m-d',
            'moni.type' => 'required',
            'moni.leadBy' => 'required',
            'moni.participant' => 'required',
            'moni.no_of_participant' => 'required',
            // 'moni.observation' => 'required',
            // 'moni.suggestion' => 'required',
            // 'moni.improvement' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:20480',
            'moni.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),
           
        ];
    }

    public function messages()
    {
        return [
           
            'moni.date.required' => 'Date is required.',
            'moni.date.date_format' => 'Date Format not match.',
            'moni.type.required' => 'Monitoring Type is required.',
            'moni.leadBy.required' => 'Lead By is required.',
            'moni.participant.required' => 'Participants  is required.',
            'moni.no_of_participant.required' => 'Number of participants  is required.',
            'moni.observation.required' => 'Observation is required.',
            'moni.suggestion.required' => 'Suggestion is required.',
            'moni.improvement.required' => 'Improvement is required.',
            'file.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            'moni.project_id.required'=>'Project Name is required.',
           
        ];
    }
}
