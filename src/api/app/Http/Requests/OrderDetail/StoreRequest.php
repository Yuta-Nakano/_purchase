<?php

namespace App\Http\Requests\OrderDetail;

use App\Models\OrderDetail;
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
            'order_id'    => 'オーダーID',
            'standard_id' => '規格ID',
            'quantity'    => '数量',
            'unit_price'  => '単価',
            'tax'         => '税',
            'shipping'    => '送料',
        ];
    }

    public function rules(): array
    {
        return [
            'order_id'    => 'required|integer|exists:App\Models\Order,id',
            'standard_id' => 'required|integer|exists:App\Models\ProductStandard,id',
            'quantity'    => 'required|numeric|min:1',
            'unit_price'  => 'required|numeric|min:0',
            'tax'         => 'required|numeric|min:0',
            'shipping'    => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            '*.exists'  => '選択した:attributeが無効です。',
            '*.integer' => ':attributeは整数でなければなりません。',
            '*.min'     => [
                'numeric' => ':attributeは少なくとも:minである必要があります。',
            ],
            '*.numeric'  => ':attributeは数値でなければなりません。',
            '*.required' => ':attributeは必須項目です。',
        ];
    }

    public function makeOrderDetail(): OrderDetail
    {
        return new OrderDetail($this->validated());
    }
}
