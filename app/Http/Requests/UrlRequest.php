<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
{
    public function rules()
    {
        return [
            'url.instagram' => 'nullable|url',
            'url.line' => 'nullable|url',
        ];
    }
}
