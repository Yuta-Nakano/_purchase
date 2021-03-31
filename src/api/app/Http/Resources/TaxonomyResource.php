<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxonomyResource extends JsonResource
{
    public static $wrap = 'taxonomy';

    public function toArray($request): array
    {
        return [
            'term'   => $this->when($this->term, new TermResource($this->term)),
            'parent' => $this->when($this->parent, new TermResource($this->parent), null),
        ];
    }
}
