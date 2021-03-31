<?php

namespace App\UseCases\UserPayment;

use App\Models\UserPayment;
use Illuminate\Support\Facades\DB;

class UpdateAction
{
    public function __invoke(UserPayment $payment): UserPayment
    {
        assert($payment->exists);

        DB::beginTransaction();
        try {
            $payment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $payment->refresh();
        return $payment;
    }
}
