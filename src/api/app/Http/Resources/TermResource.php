<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
{
    public static $wrap = 'term';

    public function toArray($request): array
    {
        return [
            'name'     => $this->resource->name,
            'slug'     => $this->resource->slug,
            'taxonomy' => $this->when($this->taxonomy, $this->taxonomy->name, null),
        ];
    }
}
