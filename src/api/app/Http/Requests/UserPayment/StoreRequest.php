<?php

namespace App\Http\Requests\UserPayment;

use App\Models\UserPayment;
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
            'user_id'                => 'ユーザーID',
            'payment_type'           => '決済種別',
            'credit_card_type'       => 'カード種別',
            'credit_card_numbar'     => 'カード番号',
            'credit_expiration_date' => 'カード有効期限',
        ];
    }

    public function rules(): array
    {
        $rules = [
            'user_id'                => 'required|integer|exists:App\Models\User,id',
            'payment_type'           => 'required|string|in:credit_card,bank_transfer',
            'credit_card_type'       => 'string',
            'credit_card_numbar'     => 'string',
            'credit_expiration_date' => 'string',
        ];

        if ($this->payment_type && $this->payment_type === 'credit_card') {
            $rules['credit_card_type']       .= '|required';
            $rules['credit_card_numbar']     .= '|required';
            $rules['credit_expiration_date'] .= '|required';
        }
        else {
            $rules['credit_card_type']       .= '|nullable';
            $rules['credit_card_numbar']     .= '|nullable';
            $rules['credit_expiration_date'] .= '|nullable';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.exists'   => '選択した:attributeが無効です。',
            '*.in'       => '選択した:attributeが無効です。',
        ];
    }

    public function makeUserPayment(): UserPayment
    {
        return new UserPayment($this->validated());
    }
}
