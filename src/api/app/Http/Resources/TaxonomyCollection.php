<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaxonomyCollection extends ResourceCollection
{
    public $collects = TaxonomyResource::class;
    public static $wrap = 'taxonomies';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
