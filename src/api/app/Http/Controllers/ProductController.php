<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\UseCases\Product\StoreAction;
use App\UseCases\Product\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        $products = Product::paginate();
        return new ProductCollection($products, 200);
    }

    public function store(StoreRequest $request, StoreAction $action): ProductResource
    {
        $product = $request->makeProduct();

        try {
            return new ProductResource($action($product));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(Request $request, Product $product): ProductResource
    {
        return new ProductResource($product, 200);
    }

    public function update(UpdateRequest $request, Product $product, UpdateAction $action): ProductResource
    {
        $product = $request->fillProduct($product);

        try {
            return new ProductResource($action($product));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
