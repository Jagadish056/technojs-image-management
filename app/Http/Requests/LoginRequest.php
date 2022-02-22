<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'email', 'min:4', 'max:225'],
            'password' => ['required', Password::defaults()],
        ];
    }
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return back()->with(feedback('Invalid form submitted.', 'error'));
        }
    }
}
