<?php

namespace App\Policies;

use App\User;
use App\Buyer;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Buyer $buyer)
    {
        return $user->ownBuyer($buyer);
    }
}
