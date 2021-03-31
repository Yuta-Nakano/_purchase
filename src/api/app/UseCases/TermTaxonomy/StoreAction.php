<?php

namespace App\UseCases\TermTaxonomy;

use App\Models\Taxonomy;
use App\Models\Term;
use Illuminate\Support\Facades\DB;

class StoreAction
{
    public function __invoke(Term $term, Taxonomy $taxonomy): Term
    {
        assert(!$term->exists);

        DB::beginTransaction();
        try {
            $term->save();
            $taxonomy->term_id = $term->id;
            $taxonomy->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $term->refresh();
        return $term;
    }
}
