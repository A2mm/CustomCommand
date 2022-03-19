<?php

namespace App\Http\Requests\Api\V1\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentApiRequest extends FormRequest
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
            
            'name' => [
                'required',
                'string',
                'unique:students,name,'.request()->route('student')->id
            ],


            'school_id' => [
                'required',
                'integer',
                'exists:schools,id'
            ],

        ];
    }
}
