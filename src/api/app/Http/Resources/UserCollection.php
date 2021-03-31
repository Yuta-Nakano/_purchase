<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;
    public static $wrap = 'users';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
