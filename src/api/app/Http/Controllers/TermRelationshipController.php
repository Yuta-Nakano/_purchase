<?php

namespace App\Http\Controllers;

use App\Http\Requests\TermRelationship\StoreRequest;
use App\Http\Resources\TermRelationshipResource;
use App\Models\TermRelationship;
use App\UseCases\TermRelationship\StoreAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermRelationshipController extends Controller
{
    public function store(StoreRequest $request, StoreAction $action): TermRelationshipResource
    {
        $termRelationship = $request->makeTermRelationship();

        try {
            return new TermRelationshipResource($action($termRelationship));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }

    }

    public function destroy(TermRelationship $termRel)
    {
        DB::beginTransaction();
        try {
            $termRel->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
