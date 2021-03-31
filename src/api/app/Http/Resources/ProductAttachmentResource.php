<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttachmentResource extends JsonResource
{
    public static $wrap = 'attachment';

    public function toArray($request): array
    {
        return [
            'product' => $this->when($this->product, $this->product),
            'file'    => $this->when($this->file, $this->file),
        ];
    }
}
