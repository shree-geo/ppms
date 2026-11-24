<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ProgramsRequest extends FormRequest
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

            'programs.program_type_id' => 'required',
            'programs.program_title' => 'required',
            'programs.program_details' => 'required',
            'programs.start_date' => 'required|date_format:Y-m-d',
            'programs.end_date' => 'required|date_format:Y-m-d',
            'programs.bramin_f' => 'required|integer|min:0',
            'programs.bramin_m' => 'required|integer|min:0',
            'programs.dalit_f' => 'required|integer|min:0',
            'programs.dalit_m' => 'required|integer|min:0',
            'programs.janjati_f' => 'required|integer|min:0',
            'programs.janjati_m' => 'required|integer|min:0',
            'programs.others_f' => 'required|integer|min:0',
            'programs.others_m' => 'required|integer|min:0',
            'programs.muslim_f' => 'required|integer|min:0',
            'programs.muslim_m' => 'required|integer|min:0',
            'programs.project_id'=>Rule::requiredIf(function() use ($user_group){
                return $user_group==1 || $user_group==3;
            }),
            'file.*'=>'nullable|mimes:png,jpg,pdf|max:20480',
           
        ];
    }

    public function messages()
    {
        return [
            'file.*.max'=>'File must not be greater than 20 MB',

            'programs.program_type_id.required' => 'Programs Type is required.',
            'programs.program_title.required' => 'Programs Title is required.',
            'programs.program_details.required' => 'Programs Details is required.',
            'programs.start_date.required' => ' Start Date is required.',
            'programs.end_date.required' => 'End Date is required.',
            'programs.bramin_f.required' => 'Female Count is required.',
            'programs.bramin_f.integer' => 'Female Count must be integer.',
            'programs.bramin_m.required' => 'Male Count is required.',
            'programs.bramin_m.integer' => 'Male Count must be integer.',
            'programs.dalit_f.required' => 'Female Count is required.',
            'programs.dalit_f.integer' => 'Female Count must be integer.',
            'programs.dalit_m.required' => 'Male Count is required.',
            'programs.dalit_m.integer' => 'Male Count must be integer.',
            'programs.janjati_f.required' => 'Female Count is required.',
            'programs.janjati_f.integer' => 'Female Count must be integer.',
            'programs.janjati_m.required' => 'Male Count is required.',
            'programs.janjati_m.integer' => 'Male Count must be integer.',
            'programs.others_f.required' => 'Female Count is required.',
            'programs.others_f.integer' => 'Female Count must be integer.',
            'programs.others_m.required' => 'Male Count is required.',
            'programs.others_m.integer' => 'Male Count must be integer.',
            'programs.muslim_f.required' => 'Female Count is required.',
            'programs.muslim_f.integer' => 'Female Count must be integer.',
            'programs.muslim_m.required' => 'Male Count is required.',
            'programs.muslim_m.integer' => 'Male Count must be integer.',
            'programs.project_id.required'=>'Project Name is required.',
            'programs.end_date.date_format' => 'Date Format not match' ,
            'programs.start_date.date_format' => 'Date Format not match' ,

        ];
    }
}
