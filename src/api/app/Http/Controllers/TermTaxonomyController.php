<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermTaxonomy\StoreRequest;
use App\Http\Requests\TermTaxonomy\UpdateRequest;
use App\Http\Resources\TaxonomyCollection;
use App\Http\Resources\TermResource;
use App\Models\Taxonomy;
use App\Models\Term;
use App\UseCases\TermTaxonomy\StoreAction;
use App\UseCases\TermTaxonomy\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermTaxonomyController extends Controller
{
    public function index(Request $request): TaxonomyCollection
    {
        $taxonomyName = $request->segment(1);
        $taxonomies   = Taxonomy::where('name', $taxonomyName)->paginate();
        return new TaxonomyCollection($taxonomies, 200);
    }

    public function store(StoreRequest $request, StoreAction $action): TermResource
    {
        $term       = $request->makeTerm();
        $taxonomy   = $request->makeTaxonomy();

        $taxonomies = Taxonomy::getIsTermsSameTaxonomy($taxonomy->name, $term);
        if ($taxonomies->count()) {
            abort(response(['message' => 'スラッグ名はすでに取得されています。'], 500));
        }

        try {
            return new TermResource($action($term, $taxonomy));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(Request $request, Term $term): TermResource
    {
        $term->refresh();
        return new TermResource($term, 201);
    }

    public function update(
        UpdateRequest $request,
        Term $term,
        UpdateAction $action
    ): TermResource
    {
        $validated = $request->validated();

        $term
            ->load('taxonomy')
            ->fill($validated['term']);

        $taxonomy = $term
            ->taxonomy
            ->fill($validated['taxonomy']);

        $taxonomies = Taxonomy::getIsTermsSameTaxonomy($taxonomy->name, $term);
        if ($taxonomies->count()) {
            abort(response(['message' => 'スラッグ名はすでに取得されています。'], 500));
        }

        try {
            return new TermResource($action($term, $taxonomy));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(Term $term)
    {
        $childCount = Taxonomy::where('parent_id', $term->id)->count();
        if ($term->taxonomy->parent_id === null && $childCount) {
            abort(response(['message' => $childCount . '件の子要素が存在する為、削除できません。'], 500));
        }

        DB::beginTransaction();
        try {
            $term->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
