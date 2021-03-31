<?php

namespace App\Http\Requests\UserAddress;

use App\Models\UserAddress;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id'      => 'ユーザーID',
            'dist_name'    => 'お届け先名',
            'last_name'    => '姓',
            'fast_name'    => '名',
            'post_code'    => '郵便番号',
            'prefecture'   => '都道府県',
            'municipality' => '市区町村',
            'block_number' => '番地',
            'building'     => '建物・部屋番号',
            'phone_number' => '電話番号',
        ];
    }

    public function rules(): array
    {
        return [
            'user_id'      => 'required|integer|exists:App\Models\User,id',
            'dist_name'    => 'required|string',
            'last_name'    => 'required|string',
            'fast_name'    => 'required|string',
            'post_code'    => 'required|string',
            'prefecture'   => 'required|string',
            'municipality' => 'required|string',
            'block_number' => 'nullable|string',
            'building'     => 'nullable|string',
            'phone_number' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.exists'   => '選択した:attributeが無効です。',
        ];
    }

    public function fillUserAddress(UserAddress $addres): UserAddress
    {
        return $addres->fill($this->validated());
    }
}
