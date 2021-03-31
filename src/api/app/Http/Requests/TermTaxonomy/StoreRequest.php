<?php

namespace App\Http\Requests\TermTaxonomy;

use App\Models\Taxonomy;
use App\Models\Term;
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
            'term.name'          => '用語名',
            'term.slug'          => '用語スラッグ',
            'taxonomy.name'      => '分類名',
            'taxonomy.parent_id' => '親用語ID',
        ];
    }

    public function rules(): array
    {
        return [
            'term.name'          => 'required|string',
            'term.slug'          => 'required|string|alpha_dash|max:20',
            'taxonomy.name'      => 'required|string|in:category,tag',
            'taxonomy.parent_id' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            '*' => [
                '*.required' => ':attributeは必須項目です。',
                '*.string'   => ':attributeは文字列である必要があります。',
                '*.max'      => [
                    'string' => ':attributeは:max文字より大きくすることはできません。'
                ],
                '*.in'       => '選択した:attributeが無効です。',
                '*.integer'  => ':attributeは整数でなければなりません。',
                '*.alpha_dash' => ':attributeには、文字、数字、ダッシュ、およびアンダースコアのみを含めることができます。',
            ],
        ];
    }

    public function makeTerm(): Term
    {
        $validated = $this->validated();
        return new Term($validated['term']);
    }

    public function makeTaxonomy(): Taxonomy
    {
        $validated = $this->validated();
        return new Taxonomy($validated['taxonomy']);
    }
}
