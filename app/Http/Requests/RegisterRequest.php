<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user.username' => ['required'],
            'user.email' => ['required'],
            'user.encrypted_password' => ['required'],
            'user.phone' => ['required'],
            'user.address' => ['required'],
            'user.city' => ['required', 'string'],
            'user.country' => ['required'],
            'user.name' => ['required'],
            'user.postcode' => ['required'],
        ];
    }

    public function getData(): array
    {
        return array_merge($this->user, [
            'password' => Hash::make($this->user['encrypted_password'])
        ]);
    }
}
