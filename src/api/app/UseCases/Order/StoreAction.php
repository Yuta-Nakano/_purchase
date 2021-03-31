<?php

namespace App\UseCases\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(Order $order): Order
    {
        assert(!$order->exists);

        DB::beginTransaction();
        try {
            $order->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $order->refresh();
        return $order;
    }
}
