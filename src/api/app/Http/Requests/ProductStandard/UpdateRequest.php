<?php

namespace App\Http\Requests\ProductStandard;

use App\Models\ProductStandard;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(Gate $gate): Response
    {
        // return $gate->authorize('store', [ProductStandard::class]);
        return Response::allow();
    }

    public function attributes(): array
    {
        return [
            'name'            => '規格名',
            'code'            => '規格コード',
            'thumb_id'        => 'サムネイルID',
            'thumb_target_id' => 'サムネイル対象ID',
            'status'          => 'ステータス',
            'stock'           => '在庫',
            'price'           => '価格',
        ];
    }

    public function rules(): array
    {
        $rules = [
            'name'            => 'required|string',
            'code'            => 'required|string|alpha_dash|max:20|unique:App\Models\ProductStandard,code',
            'thumb_id'        => 'required|integer|exists:App\Models\ProductAttachment,id',
            'thumb_target_id' => 'nullable|integer|exists:App\Models\ProductAttachment,id',
            'status'          => 'required|string|in:private,publish',
            'stock'           => 'required|numeric|integer|min:-1',
            'price'           => 'required|numeric|integer',
        ];

        if ($this->standard && $this->code) {
            $rules['code'] = $rules['code'] . ',' . $this->standard->id . ',code';
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
            '*.min'      => [
                'numeric' => ':attributeは少なくとも:minである必要があります。',
            ],
            '*.in'         => '選択した:attributeが無効です。',
            '*.numeric'    => ':attributeは数値でなければなりません。',
            '*.integer'    => ':attributeは整数でなければなりません。',
            '*.exists'     => '選択した:attributeが無効です。',
            '*.unique'     => ':attributeはすでに取得されています。',
            '*.alpha_dash' => ':attributeには、文字、数字、ダッシュ、およびアンダースコアのみを含めることができます。',
        ];
    }

    public function fillProductStandard(ProductStandard $standard): ProductStandard
    {
        return $standard->fill($this->validated());
    }
}
