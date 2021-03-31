<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPayment\StoreRequest;
use App\Http\Requests\UserPayment\UpdateRequest;
use App\Http\Resources\UserPaymentCollection;
use App\Http\Resources\UserPaymentResource;
use App\Models\User;
use App\Models\UserPayment;
use App\UseCases\UserPayment\StoreAction;
use App\UseCases\UserPayment\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPaymentController extends Controller
{
    public function index(User $user): UserPaymentCollection
    {
        $payments = UserPayment::paginate();
        return new UserPaymentCollection($payments, 200);
    }

    public function store(
        StoreRequest $request,
        User $user,
        StoreAction $action
    ): UserPaymentResource
    {
        $payment = $request->makeUserPayment();

        try {
            return new UserPaymentResource($action($payment));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(
        Request $request,
        User $user,
        UserPayment $payment
    ): UserPaymentResource
    {
        return new UserPaymentResource($payment, 200);
    }

    public function update(
        UpdateRequest $request,
        User $user,
        UserPayment $payment,
        UpdateAction $action
    ): UserPaymentResource
    {
        $payment = $request->fillUserPayment($payment);

        try {
            return new UserPaymentResource($action($payment));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(
        User $user,
        UserPayment $payment
    )
    {
        DB::beginTransaction();
        try {
            $payment->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
