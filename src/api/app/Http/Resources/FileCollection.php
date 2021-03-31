<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FileCollection extends ResourceCollection
{
    public $collects = FileResource::class;
    public static $wrap = 'files';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
