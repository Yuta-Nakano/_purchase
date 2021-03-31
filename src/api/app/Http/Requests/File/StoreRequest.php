<?php

namespace App\Http\Requests\File;

use App\Models\File;
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
            'name' => 'タイトル',
            'file' => 'ファイル',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'file' => 'required|file',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.max'      => [
                'string' => ':attributeは:max文字より大きくすることはできません。'
            ],
            '*.file' => ':attributeはファイルである必要があります。',
        ];
    }

    public function makeFile(): File
    {
        return new File($this->validated());
    }
}
