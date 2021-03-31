<?php

namespace App\Policies;

use App\Models\ProductStandard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductStandardPolicy
{
    use HandlesAuthorization;

    public function store(User $user): Response
    {
        return true
            ? $this->allow()
            : $this->deny('ユーザは存在しません');
    }

    public function update(User $user): Response
    {
        return true
            ? $this->allow()
            : $this->deny('ユーザは存在しません');
    }
}
