<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProject extends FormRequest
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
            'project_code' => 'required',
            'project_name' => 'required',
//            'status_req' => 'sometimes|required|status_req',
//            'status_req' => 'required_with,status_req'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'project_code.required' => 'Please enter a code for the project.',
            'project_name.required' => 'Please enter a name for the project.',
//            'status_req.required' => 'Please enter status for this date.',
        ];
    }
}
