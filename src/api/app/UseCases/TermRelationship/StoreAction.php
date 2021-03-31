<?php

namespace App\UseCases\TermRelationship;

use App\Models\TermRelationship;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(TermRelationship $termRelationship): TermRelationship
    {
        assert(!$termRelationship->exists);

        DB::beginTransaction();
        try {
            $termRelationship->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $termRelationship->refresh();
        return $termRelationship;
    }
}
