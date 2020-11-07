<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Buyer;
use App\Product;
use App\Order;

class BuyerController extends Controller
{
    public function updateProfile(Request $request, Buyer $buyer)
    {
        $this->authorize('update', $buyer);
        $buyer->name = $request->get('name', $buyer->name);
        $buyer->email = $request->get('email', $buyer->email);
        $buyer->birthdate = $request->get('birthdate', $buyer->birthdate);
        $buyer->address = $request->get('address', $buyer->address);
        if ($buyer->save();) {
            return response()->json(['message' => 'profile has been updated'], 200);
        }
    }
}
