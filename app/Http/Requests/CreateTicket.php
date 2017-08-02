<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicket extends FormRequest
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
            'subject' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages() {
        return [
            'subject.required' => 'Please enter a about your issue.',
            'description.required' => 'Please enter description of the issue you are having.',
        ];
    }
}
