<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name'     => 'ユーザー名',
            'password' => 'パスワード',
            'email'    => 'Eメール',
            'birthday' => '生年月日',
            'sex'      => '性別',
        ];
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|alpha_dash|not_in:address,register|unique:App\Models\User,name',
            'password' => 'required|string|min:8',
            'email'    => 'required|unique:App\Models\User,email',
            'birthday' => 'nullable|string|date',
            'sex'      => 'nullable|string|in:male,female',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.max'      => [
                'string' => ':attributeは:max文字より大きくすることはできません。'
            ],
            '*.min'      => [
                'string' => ':attributeは少なくとも:min文字である必要があります。',
            ],
            '*.date'       => ':attributeは有効な日付ではありません。',
            '*.unique'     => ':attributeはすでに取得されています。',
            '*.alpha_dash' => ':attributeには、文字、数字、ダッシュ、およびアンダースコアのみを含めることができます。',
            '*.in'         => '選択した:attributeが無効です。',
            '*.not_in'     => '選択した:attributeが無効です。',
        ];
    }

    public function makeUser(): User
    {
        return new User($this->validated());
    }
}
