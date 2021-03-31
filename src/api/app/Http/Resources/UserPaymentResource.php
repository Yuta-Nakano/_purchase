<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPaymentResource extends JsonResource
{
    public static $wrap = 'payment';

    public function toArray($request): array
    {
        return [
            'paymentType'          => $this->resource->payment_type,
            'creditCardType'       => $this->resource->credit_card_type,
            'creditCardNumbar'     => $this->resource->credit_card_numbar,
            'creditExpirationDate' => $this->resource->credit_expiration_date,
            'billingAddress'       => $this->when($this->billingAddress, $this->billingAddress),
        ];
    }
}
