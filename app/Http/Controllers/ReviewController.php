<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function addreview(Request $request){

        
        if(!Auth::check()) return redirect('/login');
        
        
        $user= Auth::user();

        Review::create([
            'comment' => $request['reviewText'],
            'title' => $request['title'],
            'score' => $request['rating'],
            'date' => now(),
            'product_id' => $request['id_product'],
            'users_id' => $user->id,
        ]);
        
        return redirect()->back()->with('message', 'Successful review!');
    
    }
}