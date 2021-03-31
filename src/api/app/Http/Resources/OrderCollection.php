<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;
    public static $wrap = 'orders';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
