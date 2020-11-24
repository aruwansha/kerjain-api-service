<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'name', 'email', 'birthdate', 'address', 'category',
        'service_name', 'shop_description', 'bank_name',
        'bank_invoice'
    ];

    protected $hidden = [
        'birthdate', 'bank_name',
        'bank_invoice'
    ];
}
