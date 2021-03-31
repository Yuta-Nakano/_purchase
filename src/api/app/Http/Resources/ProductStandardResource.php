<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductStandardResource extends JsonResource
{
    public static $wrap = 'standard';

    public function toArray($request): array
    {
        return [
            'id'          => $this->resource->id,
            'name'        => $this->resource->name,
            'code'        => $this->resource->code,
            'thumb'       => $this->when($this->thumb, new FileResource($this->thumb)),
            'thumbTarget' => $this->when($this->thumbTarget, new FileResource($this->thumbTarget), new FileResource($this->thumb)),
            'status'      => $this->resource->status,
            'stock'       => $this->resource->stock,
            'price'       => $this->resource->price,
            'product'     => $this->when($this->product, $this->product),
        ];
    }
}
