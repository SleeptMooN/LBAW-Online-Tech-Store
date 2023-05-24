<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\Product;
use App\Models\WishList;



class WishListController extends Controller
{
    public function wishlist() {
        $wishlist = Wishlist::where("users_id", Auth::id())->get();
        return view('pages.wishlist',compact('wishlist'));
    }

    public function updateWishlist(Request $request)
    {
        $product_id = $request-> input('product_id');

        if(Auth::check()){
            $prod_id=$request->input('product_id');
            if(Product::find($prod_id)){
                if(wishlist::where('product_id',$product_id)->where('users_id',Auth::id())->exists()){
                    return response()->json(['status' =>" Already added to wishlist"]);
                }
                $wish = new WishList();
                $wish->product_id = $prod_id;
                $wish->users_id = Auth::id();
                $wish->save();
                return response()->json(['status' => " Product added to wishlist"]);
            }
            else{
                return response()->json(['status' => 'Product dont exists']);
            }
        } else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function removeWishlist(Request $request){

        if(Auth::check()){

            $product_id = $request->input('product_id');
            if(wishlist::where('product_id',$product_id)->where('users_id',Auth::id())->exists()){
                $wish = wishlist::where('product_id',$product_id)->where('users_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['status'=> "Items removed Successfully"]);
            }
        } else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }
}
