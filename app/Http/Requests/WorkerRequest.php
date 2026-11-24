<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class WorkerRequest extends FormRequest
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
            'worker.project_id'=> Rule::requiredIf( function () use ($user_group){
                return $user_group == 1 || $user_group==3;
            }),
            'worker.bramin_f' => 'required|integer|min:0',
            'worker.bramin_m' => 'required|integer|min:0',
            'worker.dalit_f' => 'required|integer|min:0',
            'worker.dalit_m' => 'required|integer|min:0',
            'worker.janjati_f' => 'required|integer|min:0',
            'worker.janjati_m' => 'required|integer|min:0',
            'worker.muslim_f' => 'required|integer|min:0',
            'worker.muslim_m' => 'required|integer|min:0',
            'worker.others_f' => 'required|integer|min:0',
            'worker.others_m' => 'required|integer|min:0',
            'worker.bramin_f' => 'required|integer|min:0',
            'worker.year'=>'required',
            'worker.month'=>'required',
            'worker.local_f' => 'required|integer|min:0',
            'worker.local_m' => 'required|integer|min:0',
            'worker.skill_male' => 'required|integer|min:0',
            'worker.skill_female' => 'required|integer|min:0',
            'worker.unskill_male' => 'required|integer|min:0',
            'worker.unskill_female' => 'required|integer|min:0',

          
        ];
    }

    public function messages()
    {
        return [
           
            'worker.project_id.required'=>'Project Name is required.',
            'worker.bramin_f.required' => 'Female Count is required.',
            'worker.bramin_m.required' => 'Male Count is required.',
            'worker.dalit_f.required' => 'Female Count is required.',
            'worker.dalit_m.required' => 'Male Count is required.',
            'worker.janjati_f.required' => 'Female Count is required.',
            'worker.janjati_m.required' => 'Male Count is required.',
            'worker.muslim_f.required' => 'Female Count is required.',
            'worker.muslim_m.required' => 'Male Count is required.',
            'worker.others_f.required' => 'Female Count is required.',
            'worker.others_m.required' => 'Male Count is required.',
            'worker.year.required'=>'Year is required',
            'worker.month.required'=>'Month is required',
            'worker.local_f.required' => 'Female Count is required.',
            'worker.local_m.required' => 'Male Count is required.',
            'worker.unskill_male.required' => 'Male Count is required.',
            'worker.unskill_female.required' => 'Female Count is required.',
            'worker.skill_male.required' => 'Male Count is required.',
            'worker.skill_female.required' => 'Female Count is required.',
        ];
    }
}
