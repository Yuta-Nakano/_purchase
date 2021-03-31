<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\UseCases\User\StoreAction;
use App\UseCases\User\UpdateAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(): UserCollection
    {
        $users = User::paginate();
        return new UserCollection($users, 200);
    }

    public function store(StoreRequest $request, StoreAction $action): UserResource
    {
        $user = $request->makeUser();

        try {
            return new UserResource($action($user));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }

    public function show(Request $request, User $user): UserResource
    {
        return new UserResource($user, 200);
    }

    public function update(UpdateRequest $request, User $user, UpdateAction $action): UserResource
    {
        $user = $request->fillUser($user);

        try {
            return new UserResource($action($user));
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }
    }


    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }
}
