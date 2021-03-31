<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;
    public static $wrap = 'products';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
