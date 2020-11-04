<?php

namespace App\Policies;

use App\User;
use App\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Seller $seller)
    {
        return $user->ownProfile($seller);
    }
}
