<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\View;

use Auth;

class HomePageController extends Controller
{
  /**
   * Show the application home page.
   *
   */
  public function index()
  {
    $id = Auth::id();

    $cart = cart::join('product', 'product_id', '=', 'product.id')
            ->where('users_id', $id)
            ->get();
       
    $smartphone = Product::where('category_id', 1)->take(10)->get();
    $tablets = Product::where('category_id', 2)->take(10)->get();
    $computers = Product::where('category_id', 3)->take(10)->get();
    $accessories = Product::where('category_id', 4)->take(10)->get();
    
    return view('pages.home',[
        'smartphone' => $smartphone,
        'computers' => $computers,
        'accessories' => $accessories,
        'tablets' => $tablets
    ]);
  }

    /**
   * Show the application about page.
   *
   */
  public function about() {
    return view('pages.about');
  }

  /**
   * Show the application Terms and conditions page.
   *
   */
  public function terms() {
    return view('pages.terms');
  }

  /**
   * Show the application faq page.
   *
   */
  public function faq() {
    return view('pages.faq');
  }

  /**
   * Show the application contact page.
   *
   */
  
  public function contact() {
    return view('pages.contact');
  }

}
