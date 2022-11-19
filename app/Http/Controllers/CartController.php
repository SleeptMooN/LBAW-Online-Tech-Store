<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public funcion

    public function show() {
        // get user id
        $id = Auth::id();
 
        $total = 0;
        // dd($total);  

        return view('cart.index',[
        
            'total' => $total,
        
        ]);
    }
}

