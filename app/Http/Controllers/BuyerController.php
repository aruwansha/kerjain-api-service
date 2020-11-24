<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Buyer;
use App\Seller;

class BuyerController extends Controller
{
    public function updateProfile(Request $request, Buyer $buyer)
    {
        $this->authorize('update', $buyer);
        $buyer->name = $request->get('name', $buyer->name);
        $buyer->email = $request->get('email', $buyer->email);
        $buyer->birthdate = $request->get('birthdate', $buyer->birthdate);
        $buyer->address = $request->get('address', $buyer->address);
        if ($buyer->save()) {
            return response()->json(['message' => 'profile has been updated'], 200);
        }
    }

    public function getBestSeller()
    {
        $paginator = Seller::select('id','name', 'category', 'service_name', 
                            'shop_description')
                            ->Paginate(10);
        $sellerList = $paginator->getCollection();
        return response()->json($sellerList, 200);
    }

    public function getDetailSeller($id)
    {
        $seller = DB::table('sellers AS s')
                        ->join('products AS p', 's.id', '=', 'p.seller_id')
                        ->select('p.id AS product_id', 's.name AS seller_name', 
                        'address AS seller_address', 'category', 'service_name', 
                        'shop_description', 'p.name AS product_name', 
                        'description AS product_description', 'price', 'picture')
                        ->get();
        return response()->json($seller, 200);
    }
}
