<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Seller;
use App\Product;
use App\Order;

class SellerController extends Controller
{
    public function updateProfile(Request $request, Seller $seller)
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

    public function getProductList()
    {
        $seller_id = DB::table('sellers')->where('user_id', Auth::user()->id)->value('id');
        $total_product = DB::table('products')->where('seller_id', $seller_id)->get();
        return response()->json($total_product, 200);
    }

    public function addProduct(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required',
            'picture' => 'required'
        ]);

        $seller_id = DB::table('sellers')->where('user_id', Auth::user()->id)->value('id');
        $total_product = DB::table('products')->where('seller_id', $seller_id)->count();
        if ($total_product >= 3) {
            return response()->json(['message' =>'The number of products has reached the limit'], 201);
        } else{
            $storeToDatabase = $product->create([
                'seller_id' => $seller_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'picture' => $request->picture,
            ]);

            if($storeToDatabase != null){
                return response()->json(['berhasil'], 201);
            }
        }
    }

    public function updateProduct(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->name = $request->get('name', $product->name);
        $product->description = $request->get('description', $product->description);
        $product->price = $request->get('price', $product->price);
        $product->picture = $request->get('picture', $product->picture);
        $product->save();
        return response()->json(['message' => 'product has been updated'], 200);
    }

    public function deleteProduct(Product $product)
    {
        $this->authorize('delete', $product);
        return response()->json(['message' => 'product has been deleted'], 410);
    }

    public function getOrderList(Request $request, Order $order)
    {

    }

    public function acceptOrder(Request $request, Order $order)
    {

    }

    public function declineOrder(Request $request, Order $order)
    {

    }
}
