<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRegister extends FormRequest
{
    protected $errorBag = 'register';

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
            'register_email' => 'required|unique:users,email',
            'register_password' => 'required|min:8|max:16|confirmed'
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'first_name.required' => 'Please enter a first name for the user.',
            'last_name.required' => 'Please enter a last name for the user.',
            'register_email.required' => 'An email address is required.',
            'register_email.unique' => 'This email address already exists.',
            'register_password.required' => 'You must supply a password to register.',
            'register_password.confirmed' => 'Your passwords do not match.',
        ];
    }
}
