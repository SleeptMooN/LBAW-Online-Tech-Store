<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index(){
        $old_cartitems = Cart::where('users_id',Auth::id())->get();
        foreach($old_cartitems as $items){
            if(!Product::where('id', $items->product_id)->where('quantity','>=',$items->quantity)->exists()){
                $removeItem = Cart::where('users_id',Auth::id())->where('product_id',$items->product_id)->first();
                $removeItem -> delete();
            }
        }
        $cartitems = Cart::where('users_id',Auth::id())->get();
        return view('checkout.order',compact('cartitems'));
        
    }

    
}
