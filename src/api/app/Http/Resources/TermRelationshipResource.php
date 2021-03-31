<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TermRelationshipResource extends JsonResource
{
    public static $wrap = 'termRelationship';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
