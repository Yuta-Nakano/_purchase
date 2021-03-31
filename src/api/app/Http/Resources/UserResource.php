<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id'              => $this->resource->id,
            'name'            => $this->resource->name,
            'email'           => $this->resource->email,
            'emailVerifiedAt' => $this->resource->email_verified_at,
            'birthday'        => $this->when($this->resource->birthday, $this->resource->birthday, null),
            'sex'             => $this->resource->sex,
            'addresses'       => $this->when($this->addresses, $this->addresses),
            'billingAddress'  => $this->when($this->billingAddress, $this->billingAddress),
        ];
    }
}
