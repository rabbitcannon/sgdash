<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountLogin extends FormRequest
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
            'login_email' => 'required|email|exists:users,email',
            'login_password' => 'required|min:8|max:30',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'login_email.required' => 'Please log in with a valid email address.',
            'login_email.email' => 'Please use a valid email address format.',
            'login_email.exists' => 'Username or password is not correct, please try again.',
            'login_password.required' => 'Can\'t login without a password!',
            'login_password.min' => 'Username or password is not correct, please try again.',
            'login_password.max' => 'Username or password is not correct, please try again.',
        ];
    }
}
