<?php

namespace App\UseCases\OrderDetail;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(OrderDetail $detail): OrderDetail
    {
        assert(!$detail->exists);

        DB::beginTransaction();
        try {
            $detail->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $detail->refresh();
        return $detail;
    }
}
