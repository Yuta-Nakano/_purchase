<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPaymentCollection extends ResourceCollection
{
    public $collects = UserPaymentResource::class;
    public static $wrap = 'payments';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
