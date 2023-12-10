<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get_products()
    {
        // Get all products
        return response()->json([
            "status" => "success",
            "data" => Product::all()
        ]);
    }
    public function add_product(Request $request)
    {
        $user_role = auth()->user()->user_role;
        // If seller
        if ($user_role == 1) {
            $user_id = ["user_id" => auth()->user()->id];
            $request->merge($user_id);
            $product = Product::create($request->all());
            return response()->json([
                "status" => "success",
                "data" => $product
            ]);
        }
        else{
            return response()->json([
                "status" => "cant add product",
            ]);

        }
    }
    public function delete_product(Request $req, $id)
    {
        $user_role = auth()->user()->user_role;
        if ($user_role == 1) {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "Couldnt find product"
                ]);
            }
            $product->delete();
            return response()->json([
                "status" => "success",
                "message" => "Product deleted"
            ]);
        }
    }

    public function update_product(Request $req, $id)
    {
        $user_role = auth()->user()->user_role;
        if ($user_role == 1) {
            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    "status" => "error",
                    "message" => "couldnt find product"
                ]);
            }
            $product->update($req->all());
            return response()->json([
                "status" => "success",
                "data" => $product
            ]);
        }
    }



}
