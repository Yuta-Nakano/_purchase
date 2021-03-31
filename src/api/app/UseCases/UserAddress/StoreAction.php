<?php

namespace App\UseCases\UserAddress;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(UserAddress $address): UserAddress
    {
        assert(!$address->exists);

        DB::beginTransaction();
        try {
            $address->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $address->refresh();
        return $address;
    }
}
