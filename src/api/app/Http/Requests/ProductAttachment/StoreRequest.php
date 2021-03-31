<?php

namespace App\Http\Requests\ProductAttachment;

use App\Models\ProductAttachment;
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
            'product_id' => 'コンテンツID',
            'file_id'    => 'ファイルID',
        ];
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:App\Models\Product,id',
            'file_id'    => 'required|integer|exists:App\Models\File,id',
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

    public function makeProductAttachment(): ProductAttachment
    {
        return new ProductAttachment($this->validated());
    }
}
