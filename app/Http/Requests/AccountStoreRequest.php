<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'type' => 'nullable|string|max:50',
            'industry' => 'nullable|string|max:100',
        ];
    }
}
