<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class Login extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|exists:users',
            'password'  => 'required',
        ];
    }
}
