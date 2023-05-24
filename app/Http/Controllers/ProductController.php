<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class ProductController extends Controller
{   
   
    public function show($id){
        $product = Product::where('id', $id)->get();
        $reviews = Review::where('product_id',$id)->get();

        
        return view('product.index', [
            'product' => $product[0],
            'reviews' => $reviews
        ]);
    }
    public function redirectToHome(){
        return redirect('/');
    }
 
}
