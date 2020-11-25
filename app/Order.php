<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'seller_id', 'product_id', 'buyer_id', 'status'
    ];
}
