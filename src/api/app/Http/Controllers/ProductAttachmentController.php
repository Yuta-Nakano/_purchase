<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAttachment\StoreRequest;
use App\Http\Resources\ProductAttachmentResource;
use App\Models\ProductAttachment;
use App\UseCases\ProductAttachment\StoreAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttachmentController extends Controller
{
    public function store(StoreRequest $request, StoreAction $action): ProductAttachmentResource
    {
        $attachment = $request->makeProductAttachment();

        try {
            return new ProductAttachmentResource($action($attachment));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(ProductAttachment $attachment)
    {
        DB::beginTransaction();
        try {
            $attachment->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
