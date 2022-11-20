<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Cart;

use App\Models\User;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
//use Flash;

class ProductController extends Controller
{   
   

    public function updateCart(Request $request) {
        // dd($request->id);
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

       // Flash::success('Item removed successfully.');
        return redirect('/cart');
    }

    public function clearCart() {
        DB::table('cart')->where('users_id', Auth::id())->delete();
      //  Flash::success('Item removed successfully.');
        return redirect('/cart');
    }
    
    public function removeFromCart(Request $request) {
        $temp = cart::where('product_id',$request->id)->Where('users_id', Auth::id())->get();
        $temp = $temp[0];

        DB::table('cart')->delete($temp->id);

        //Flash::success('Item removed successfully.');
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

        // dd($request);
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

        // if cart not empty then check if this product exist then increment quantity
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

           // Flash::success('Product added to cart successfully!');
            return redirect('/cart');
        }

        $cart = [
            "users_id" => Auth::id(),
            "product_id" => $product->id,  
            "quantity" => $request->quantity
        ];
        
        DB::table('cart')->insert($cart);

        //Flash::success('Product added to cart successfully!');
        return redirect('/cart');
    }

    public function search(Request $request) {
        $search = $request->query('query');

        // Search in the title and body columns from the posts table
        $products = Product::query()
            ->where('productname', 'ilike', "%{$search}%")
            ->orWhere('description', 'ilike', "%{$search}%")
            ->simplePaginate(12);
            
        // dd($products);
        return view('layouts.search', [
            'products' => $products,
            'queryName' => $search
        ]);
    }

    public function show($id){
        $product = Product::where('id', $id)->get();
        $username = User::find($id);

        
        return view('product.index', [
            'product' => $product[0],
            'username' => $username
        ]);
    }
    public function redirectToHome(){
        return redirect('/');
    }

    public function product(){
        return $this->hasMany('App\Models\Category');
    }
    public function cart(){
        return $this->hasMany('App\Models\Cart');
    }
    // public function wishlist()
    // {
    //     return $this->hasMany('App\Models\Product');
    // }
}
