<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !auth()->check();
    }

    public function attributes(): array
    {
        return [
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|string|exists:App\Models\User,email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => 'メールアドレス、またはパスワードが無効です。',
            '*.exists'   => 'メールアドレス、またはパスワードが無効です。',
        ];
    }
}
