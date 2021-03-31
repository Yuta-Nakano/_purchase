<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse as JsonPaginatedResourceResponse;

class PaginatedResourceResponse extends JsonPaginatedResourceResponse
{
    protected function paginationInformation($request)
    {
        $paginated = $this->resource->resource->toArray();

        return [
            'pagination' => $this->meta($paginated),
        ];
    }
}
