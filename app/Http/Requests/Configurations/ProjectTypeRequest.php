<?php

namespace App\Http\Requests\Configurations;

use Illuminate\Foundation\Http\FormRequest;

class ProjectTypeRequest extends FormRequest
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
        return [
            'project_sector'=>'required',
            'type_name'=>'required',
        ];
    }
    public function message()
    {
        return[
        'project_sector'=>'Project Sector is required',
        'type_name'=>'Type Name is required',
        ];
    }
}
