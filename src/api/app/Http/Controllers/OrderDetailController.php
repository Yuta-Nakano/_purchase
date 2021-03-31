<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetail\StoreRequest;
use App\Http\Requests\OrderDetail\UpdateRequest;
use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use App\UseCases\OrderDetail\StoreAction;
use App\UseCases\OrderDetail\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(StoreRequest $request, StoreAction $action): OrderDetailResource
    {
        $orderDetail = $request->makeOrderDetail();

        try {
            return new OrderDetailResource($action($orderDetail));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(OrderDetail $orderDetail): OrderDetailResource
    {
        return new OrderDetailResource($orderDetail, 200);
    }

    public function update(UpdateRequest $request, OrderDetail $orderDetail, UpdateAction $action): OrderDetailResource
    {
        $orderDetail = $request->fillOrderDetail($orderDetail);

        try {
            return new OrderDetailResource($action($orderDetail));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(OrderDetail $orderDetail)
    {
        DB::beginTransaction();
        try {
            $orderDetail->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
