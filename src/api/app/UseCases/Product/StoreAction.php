<?php

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(Product $product): Product
    {
        assert(!$product->exists);

        DB::beginTransaction();
        try {
            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $product->refresh();
        return $product;
    }
}
