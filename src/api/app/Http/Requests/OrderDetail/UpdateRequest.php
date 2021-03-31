<?php

namespace App\Http\Requests\OrderDetail;

use App\Models\OrderDetail;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TODO: 後で直す
        return true;
    }

    public function attributes(): array
    {
        return [
            'quantity'    => '数量',
            'unit_price'  => '単価',
            'tax'         => '税',
            'shipping'    => '送料',
        ];
    }

    public function rules(): array
    {
        return [
            'quantity'    => 'required|numeric|min:1',
            'unit_price'  => 'required|numeric|min:0',
            'tax'         => 'required|numeric|min:0',
            'shipping'    => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            '*.min'     => [
                'numeric' => ':attributeは少なくとも:minである必要があります。',
            ],
            '*.numeric'  => ':attributeは数値でなければなりません。',
            '*.required' => ':attributeは必須項目です。',
        ];
    }

    public function fillOrderDetail(OrderDetail $detail): OrderDetail
    {
        return $detail->fill($this->validated());
    }
}
