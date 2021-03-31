<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = 'product';

    public function toArray($request): array
    {
        return [
            'id'      => $this->resource->id,
            'name'    => $this->resource->name,
            'slug'    => $this->resource->slug,
            'content' => $this->resource->content,
            'standards' => $this->when($this->standards, new ProductStandardCollection($this->standards)),
        ];
    }
}
