<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public funcion

    public function show() {
        
        $cartitems = Cart::where('users_id',Auth::id())->get();
        return view('cart.index',compact('cartitems'));
    }

    public function addProduct(Request $request) {
        $product_id = $request-> input('product_id');
        $quantity = $request-> input('quantity');

        if(Auth::check()){
            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check){
                if(Cart::where('product_id',$product_id)->where('users_id',Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name." Already added to cart"]);
                }else{
                $cart_item = new Cart();
                $cart_item-> product_id = $product_id;
                $cart_item-> users_id = Auth::id();
                $cart_item-> quantity = $quantity;
                $cart_item -> save();
                return response()->json(['status' => $prod_check->name." Added to cart"]);
                }
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function delProduct(Request $request) {

       if(Auth::check()){
            $product_id = $request-> input('product_id');
            if(Cart::where('product_id',$product_id)->where('users_id',Auth::id())->exists()){

                $cartItem = Cart::where('product_id',$product_id)->where('users_id',Auth::id())->first();
                $cartItem -> delete();
                return response()->json(['status' => " Product deletd successfully"]);
                }
            
        }else{
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function updatecart(Request $request) {

        $product_id = $request-> input('product_id');
        $product_quantity = $request-> input('quantity');

        if(Auth::check()){
             
             if(Cart::where('product_id',$product_id)->where('users_id',Auth::id())->exists()){
 
                 $cart = Cart::where('product_id',$product_id)->where('users_id',Auth::id())->first();
                 $cart -> quantity = $product_quantity;
                 $cart -> update();
                 return response()->json(['status' => " Quantity updated"]);
                 }
             
            }
    }

    public function cartcount() {
        $cartcount = Cart::where('users_id',Auth::id())->count();
        return response()->json(['count' => $cartcount ]);
    }
}


