<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public static $wrap = 'file';

    public function toArray($request): array
    {
        return [
            'slug'     => $this->resource->slug,
            'name'     => $this->resource->name,
            'filename' => $this->resource->filename,
            'url'      => $this->when($this->resource->url, $this->resource->url),
        ];
    }
}
