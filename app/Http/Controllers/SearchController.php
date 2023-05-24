<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function show(Request $request){
        $search = $request->query('query');

        if($request->input('search')){
             $products = Product::whereRaw('tsvectors @@ plainto_tsquery(\'english\',?)',[$request->input('search')])
                            ->orderByRaw('ts_rank(tsvectors, plainto_tsquery(\'english\',?)) DESC', [$request -> input('search')])->get();       
        }else{
            $products = Product::all();
        }

        return view('pages.SearchResults',['products' => $products]);
    }
 
}