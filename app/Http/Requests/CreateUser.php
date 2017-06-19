<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateUser extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'first_name.required' => 'Please enter a first name for the user.',
            'last_name.required' => 'Please enter a last name for the user.',
            'email.required' => 'An email address is required.',
            'email.unique' => 'This email address already exists.',
        ];
    }
}
