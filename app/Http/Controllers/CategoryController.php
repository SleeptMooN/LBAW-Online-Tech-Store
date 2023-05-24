<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function show(){
        return redirect('/');
    }

    public function products($category) {
        
        $products = Product::where('category_id', $category)->simplePaginate(5);

        
        $category = Category::where('id', $category)->get();
        return view('category.categoryProducts',[
            'products' =>  $products,
            'category' => $category[0]
        ]);
    }
}
