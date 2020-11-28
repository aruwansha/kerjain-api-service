<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;
use App\Seller;

class SellerTransformer extends TransformerAbstract
{
    public function transform(Seller $seller, User $user)
    {
        return [
            'id' => $seller->id,
            'name' => $user->name,
            'email' => $user->email,
            'address' => $seller->address,
        ];
    }
}
