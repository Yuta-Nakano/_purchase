<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public static $wrap = 'orderDetail';

    public function toArray($request): array
    {
        return [
            'order'     => $this->when($this->order, new OrderResource($this->order)),
            'standard'  => $this->when($this->standard, new ProductStandardResource($this->standard)),
            'quantity'  => $this->resource->quantity,
            'unitPrice' => $this->resource->unit_price,
            'tax'       => $this->resource->tax,
            'shipping'  => $this->resource->shipping,
        ];
    }
}
