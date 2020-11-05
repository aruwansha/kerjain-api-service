<?php

namespace App\Policies;

use App\User;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Product $product)
    {
        return $user->ownProduct($product);
    }

    public function delete(User $user, Product $product)
    {
        return $user->ownProduct($product);
    }
}
