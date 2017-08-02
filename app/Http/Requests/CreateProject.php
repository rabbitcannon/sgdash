<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'acct_manager' => 'required|not_in:-- Select One --',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'project_code.required' => 'Please enter a code for the project.',
            'project_name.required' => 'Please enter a name for the project.',
            'acct_manager.required' => 'You must add an Account Manager to the project.',
            'acct_manager.not_in' => 'You must add an Account Manager to the project.'
        ];
    }
}
