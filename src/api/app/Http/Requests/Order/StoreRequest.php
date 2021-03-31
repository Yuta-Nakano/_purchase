<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: 後で直す
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id' => '名前',
        ];
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:App\Models\User,id',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.integer'  => ':attributeは整数でなければなりません。',
            '*.exists'   => '選択した:attributeが無効です。',
        ];
    }

    public function makeOrder(): Order
    {
        return new Order($this->validated());
    }
}
