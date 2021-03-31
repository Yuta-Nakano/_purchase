<?php

namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateAction
{
    public function __invoke(User $user): User
    {
        assert($user->exists);

        DB::beginTransaction();
        try {
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(response(['message' => $e->getMessage()], 500));
        }

        $user->refresh();
        return $user;
    }
}
