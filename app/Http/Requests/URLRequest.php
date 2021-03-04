<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class URLRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => ['required', 'url','unique:links'],
        ];
    }
}
