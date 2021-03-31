<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddress\StoreRequest;
use App\Http\Requests\UserAddress\UpdateRequest;
use App\Http\Resources\UserAddressCollection;
use App\Http\Resources\UserAddressResource;
use App\Models\User;
use App\Models\UserAddress;
use App\UseCases\UserAddress\StoreAction;
use App\UseCases\UserAddress\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAddressController extends Controller
{
    public function index(User $user): UserAddressCollection
    {
        $addresses = UserAddress::paginate();
        return new UserAddressCollection($addresses, 200);
    }

    public function store(StoreRequest $request, StoreAction $action): UserAddressResource
    {
        $address = $request->makeUserAddress();

        try {
            return new UserAddressResource($action($address));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(
        Request $request,
        User $user,
        UserAddress $address
    ): UserAddressResource
    {
        return new UserAddressResource($address, 200);
    }

    public function update(
        UpdateRequest $request,
        User $user,
        UserAddress $address,
        UpdateAction $action
    ): UserAddressResource
    {
        $address = $request->fillUserAddress($address);

        try {
            return new UserAddressResource($action($address));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function destroy(User $user, UserAddress $address)
    {
        DB::beginTransaction();
        try {
            $address->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
