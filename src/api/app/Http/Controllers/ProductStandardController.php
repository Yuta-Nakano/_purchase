<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStandard\StoreRequest;
use App\Http\Requests\ProductStandard\UpdateRequest;
use App\Http\Resources\ProductStandardCollection;
use App\Http\Resources\ProductStandardResource;
use App\Models\ProductStandard;
use App\UseCases\ProductStandard\StoreAction;
use App\UseCases\ProductStandard\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductStandardController extends Controller
{
    public function index(): ProductStandardCollection
    {
        $standards = ProductStandard::paginate();
        return new ProductStandardCollection($standards);
    }

    public function store(StoreRequest $request, StoreAction $action): ProductStandardResource
    {
        $standard = $request->makeProductStandard();
        if (!$request->thumb_target_id) {
            $standard->thumb_target_id = $standard->thumb_id;
        }

        try {
            return new ProductStandardResource($action($standard));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(Request $request, ProductStandard $standard): ProductStandardResource
    {
        return new ProductStandardResource($standard);
    }

    public function update(
        UpdateRequest $request,
        ProductStandard $standard,
        UpdateAction $action
    ): ProductStandardResource
    {
        $standard = $request->fillProductStandard($standard);
        if (!$request->thumb_target_id) {
            $standard->thumb_target_id = $standard->thumb_id;
        }

        try {
            return new ProductStandardResource($action($standard));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(ProductStandard $standard)
    {
        DB::beginTransaction();
        try {
            $standard->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
