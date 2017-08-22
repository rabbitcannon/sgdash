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
            'dev_manager' => 'required|not_in:-- Select One --',
            'project_manager' => 'required|not_in:-- Select One --',
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
            'acct_manager.not_in' => 'Select One is not a valid Account Manager option.',
            'dev_manager.required' => 'You must add an Development Manager to the project.',
            'dev_manager.not_in' => 'Select One is not a valid Development Manager option.',
            'project_manager.required' => 'You must add an Project Manager to the project.',
            'project_manager.not_in' => 'Select One is not a valid Project Manager option.'
        ];
    }
}
