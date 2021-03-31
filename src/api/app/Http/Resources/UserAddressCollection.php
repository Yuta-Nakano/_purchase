<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserAddressCollection extends ResourceCollection
{
    public $collects = UserAddressResource::class;
    public static $wrap = 'addresses';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
