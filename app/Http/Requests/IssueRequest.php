<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueRequest extends FormRequest
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
            'issue.category' => 'required',
            'issue.project_id'=> Rule::requiredIf( function () use ($user_group){
              return $user_group == 1 || $user_group==3;
               }),
               'issue.number' =>'required',
               'issue.issue' =>'required',
               'issue.date' =>'required|date_format:Y-m-d',
               'files.*'=>'required|mimes:png,jpg,pdf|max:20480',
               'issue.reason' =>'required_if:issue.category,issue',
               'issue.responsibility' =>'required_if:issue.category,issue',
               'issue.action' =>'required_if:issue.category,issue',
               'issue.status' =>'required_if:issue.category,issue',
               'issue.participation' =>'required_if:issue.category,meeting',
        ];       
    }
    public function messages()
    {
        return [
            'issue.project_id.required'=>'Project Name is required.',
            'issue.category.required' => 'Category is required',
            'issue.project_id.required'=>'Project Name is required',
            'issue.number.required' =>'Number is required',
            'issue.date.required' =>'Date is required',
            'issue.date.date_format' =>'The date does not match the format Y-m-d.',
            'files.*.required'=>'File is required.',
            'files.*.max'=>'File must not be greater than 20 MB',
               'issue.issue.required' =>'Issue is required',                                                            
               'issue.reason.required_if' =>'Reason is required',
               'issue.responsibility.required_if' =>'Responsibility is required',
               'issue.action.required_if' =>'Action is required',
               'issue.status.required_if' =>'Status is required',
               'issue.participation.required_if' =>'Participation is required',
        ];
    }
}
