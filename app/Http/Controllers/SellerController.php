<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;

class SellerController extends Controller
{
    public function update(Request $request, Seller $seller)
    {
        $this->authorize('update', $seller);
        $seller->name = $request->get('name', $seller->name);
        $seller->email = $request->get('email', $seller->email);
        $seller->birthdate = $request->get('birthdate', $seller->birthdate);
        $seller->address = $request->get('address', $seller->address);
        $seller->category = $request->get('category', $seller->category);
        $seller->service_name = $request->get('service_name', $seller->service_name);
        $seller->shop_description = $request->get('shop_description', $seller->shop_description);
        $seller->bank_name = $request->get('bank_name', $seller->bank_name);
        $seller->bank_invoice = $request->get('bank_invoice', $seller->bank_invoice);

        $seller->save();
    }
}
