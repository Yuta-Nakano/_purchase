<?php

namespace App\UseCases\UserAddress;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UpdateAction
{
    public function __invoke(UserAddress $adress): UserAddress
    {
        assert($adress->exists);

        DB::beginTransaction();
        try {
            $adress->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $adress->refresh();
        return $adress;
    }
}
