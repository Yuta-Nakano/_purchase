<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public static $wrap = 'address';

    public function toArray($request): array
    {
        return [
            'id'           => $this->resource->id,
            'distName'     => $this->resource->dist_name,
            'lastName'     => $this->resource->last_name,
            'fastName'     => $this->resource->fast_name,
            'postCode'     => $this->resource->post_code,
            'prefecture'   => $this->resource->prefecture,
            'municipality' => $this->resource->municipality,
            'blockNumber'  => $this->resource->block_number,
            'building'     => $this->resource->building,
            'phoneNumber'  => $this->resource->phone_number,
            'user'         => $this->when($this->user, new UserResource($this->user)),
        ];
    }
}
