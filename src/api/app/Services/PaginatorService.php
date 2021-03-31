<?php
namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginatorService extends LengthAwarePaginator
{
    public function toArray() : array
    {
        return [
            'data'        => $this->items->toArray(),
            'currentPage' => $this->currentPage(),
            'lastPage'    => $this->lastPage(),
            'total'       => $this->total(),
            'from'        => $this->firstItem(),
            'to'          => $this->lastItem(),
        ];
    }
}
