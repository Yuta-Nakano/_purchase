<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\UseCases\Order\StoreAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): OrderCollection
    {
        $orders = Order::paginate();
        return new OrderCollection($orders, 200);
    }

    public function store(StoreRequest $request, StoreAction $action): OrderResource
    {
        $order = $request->makeOrder();

        try {
            return new OrderResource($action($order));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(Order $order): OrderResource
    {
        return new OrderResource($order, 200);
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
