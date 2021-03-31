<?php

namespace App\UseCases\ProductAttachment;

use App\Models\ProductAttachment;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(ProductAttachment $attachment): ProductAttachment
    {
        assert(!$attachment->exists);

        DB::beginTransaction();
        try {
            $attachment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $attachment->refresh();
        return $attachment;
    }
}
