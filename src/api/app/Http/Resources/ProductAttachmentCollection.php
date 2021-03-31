<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductAttachmentCollection extends ResourceCollection
{
    public $collects = ProductAttachmentResource::class;
    public static $wrap = 'attachments';

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
