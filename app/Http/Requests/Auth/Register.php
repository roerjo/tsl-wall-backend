<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class Register extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:8',
            'f_name'    => 'nullable|string',
            'l_name'    => 'nullable|string',
        ];
    }
}
