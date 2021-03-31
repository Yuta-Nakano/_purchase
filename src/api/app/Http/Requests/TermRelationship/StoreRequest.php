<?php

namespace App\Http\Requests\TermRelationship;

use App\Models\TermRelationship;
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
            'relation_type' => '関連種別',
            'relation_id'   => '関連種別ID',
            'taxonomy_id'   => '用語分類ID',
        ];
    }

    public function rules(): array
    {
        return [
            'relation_type' => 'required|string|in:product',
            'relation_id'   => 'required|integer|exists:App\Models\Product,id',
            'taxonomy_id'   => 'required|integer|exists:App\Models\Taxonomy,id',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.in'       => '選択した:attributeが無効です。',
            '*.numeric'  => ':attributeは数値でなければなりません。',
            '*.integer'  => ':attributeは整数でなければなりません。',
            '*.exists'   => '選択した:attributeが無効です。',
        ];
    }

    public function makeTermRelationship(): TermRelationship
    {
        return new TermRelationship($this->validated());
    }
}
