<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Flash;

class ProductController extends Controller
{   
   
    public function updateCart(Request $request) {
 
        $temp = cart::where('product_id',$request->id)->Where('users_id', Auth::id())
        ->get();
        $temp = $temp[0];

        DB::table('cart')->delete($temp->id);

        $cart = [
            "quantity" => $request->newQuantity,
            "users_id" => Auth::id(),
            "product_id" => $request->id  
        ];
        DB::table('cart')->insert($cart);

        return redirect('/cart');
    }

    public function clearCart() {
        DB::table('cart')->where('users_id', Auth::id())->delete();
        return redirect('/cart');
    }
    
    public function removeFromCart(Request $request) {
        $temp = cart::where('product_id',$request->id)->Where('users_id', Auth::id())->get();
        $temp = $temp[0];

        DB::table('cart')->delete($temp->id);
        return redirect('/cart');
    }

    public function checkProductInCart($input){
        $temp = cart::where('product_id',$input->id)->where('users_id', Auth::id())->get();

        if($temp->count() >= 1){
            return true;
        }
        return false;
    }

    public function addToCart(Request $request) {

        $userId = Auth::id();
        if($userId == null){
            return redirect('/login');
        }
        $productid = $request->id;
        $product = Product::find($productid);
        if(!$product) {
            abort(404);
        }

        $cart = cart::join('product', 'product_id', '=', 'product.id')->where('users_id', Auth::id())->get();


        if($this->checkProductInCart($product)) {
            $temp = cart::where('product_id',$product->id)->Where('users_id', Auth::id())->get();
            $temp = $temp[0];

            DB::table('cart')->delete($temp->id);

            $cart = [
                "users_id" => Auth::id(),
                "product_id" => $product->id,  
                "quantity" => $temp->quantity + $request->quantity
            ];

            DB::table('cart')->insert($cart);
            return redirect('/cart');
        }

        $cart = [
            "users_id" => Auth::id(),
            "product_id" => $product->id,  
            "quantity" => $request->quantity
        ];
        
        DB::table('cart')->insert($cart);
        return redirect('/cart');
    }


    public function show($id){
        $product = Product::where('id', $id)->get();
        $reviews = Review::where('product_id',$id)->simplePaginate(4);

        
        return view('product.index', [
            'product' => $product[0],
            'reviews' => $reviews
        ]);
    }
    public function redirectToHome(){
        return redirect('/');
    }
 
}
