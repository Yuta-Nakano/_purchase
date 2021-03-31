<?php

namespace App\UseCases\ProductStandard;

use App\Models\ProductStandard;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(ProductStandard $standard): ProductStandard
    {
        assert(!$standard->exists);

        DB::beginTransaction();
        try {
            $standard->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $standard->refresh();
        return $standard;
    }
}
