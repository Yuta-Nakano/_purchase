<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
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
            'name'     => '名前',
            'slug'     => 'スラッグ',
            'content'  => '本文',
        ];
    }

    public function rules(): array
    {
        $rules = [
            'name'    => 'required|string',
            'slug'    => 'required|string|alpha_dash|max:20|unique:App\Models\Product,slug',
            'content' => 'nullable|string',
        ];

        if ($this->product && $this->slug) {
            $rules['slug'] = $rules['slug'] . ',' . $this->product->id . ',slug';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.max'      => [
                'string' => ':attributeは:max文字より大きくすることはできません。'
            ],
            '*.unique'     => ':attributeはすでに取得されています。',
            '*.alpha_dash' => ':attributeには、文字、数字、ダッシュ、およびアンダースコアのみを含めることができます。',
        ];
    }

    public function fillProduct(Product $product): Product
    {
        return $product->fill($this->validated());
    }
}
