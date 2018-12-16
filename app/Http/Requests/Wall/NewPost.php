<?php

namespace App\Http\Requests\Wall;

use App\Http\Requests\FormRequest;

class NewPost extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|string',
            'description'   => 'required|string',
        ];
    }
}
