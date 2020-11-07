<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_level', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ownSeller(Seller $seller)
    {
        return auth()->id() === $seller->user_id;
    }

    public function ownBuyer(Buyer $buyer)
    {
        return auth()->id() === $buyer->user_id;
    }

    public function ownProduct(Product $product)
    {
        $seller_id = $product->seller_id;
        return auth()->id() === DB::table('sellers')->where('id', $seller_id)->value('user_id');
    }
}
