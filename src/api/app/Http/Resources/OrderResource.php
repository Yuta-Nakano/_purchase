<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public static $wrap = 'order';

    public function toArray($request): array
    {
        return [
            'user' => $this->when($this->user, new UserResource($this->user)),
        ];
    }
}
