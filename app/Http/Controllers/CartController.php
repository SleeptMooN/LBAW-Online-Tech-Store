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
        // get user id
        $id = Auth::id();
 
        $cart = cart::join('product', 'product_id', '=', 'product.id')
                ->where('users_id', $id)
                ->get();

        $total = 0;

    foreach ($cart as $item){
        $total += $item->quantity * $item->price;
}

 // dd($total);  

    return view('cart.index',[
        'cartItems' => $cart,
        'total' => $total,
     
    ]);

    }
}

