<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCartItem;
use App\Models\Product;
use App\Models\ShoppingCart;
class ShoppingCartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get_shopping_cart()
    {
        $user_role = auth()->user()->user_role;
        if ($user_role == 2) {
            $user_id = ["user_id" => auth()->user()->id];
            $productNames = ShoppingCartItem::where('user_id', $user_id)
            ->with('product:id,product_name') 
            ->get()
            ->pluck('product.product_name');

            return response()->json([
                "status" => "success",
                "data" => $productNames,
            ]);
        }

    }
    public function add_shopping_cart(Request $request)
    {
        $userRole = auth()->user()->user_role;

        if ($userRole == 2) {
            $user = auth()->user();
            $user_id = $user->id;

            $request->merge(['user_id' => $user_id]);
            $products = $request->products;

            $shoppingCart = ShoppingCart::create($request->all());

            $shoppingCartItems = [];

            foreach ($request->products as $product) {
                $shoppingCartItems[] = $shoppingCart->products()->create([
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                ]);
            }

            return response()->json([
                'status' => 'success',
                'data' => $shoppingCartItems,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Not authorized',
            ]);
        }
    }
}

