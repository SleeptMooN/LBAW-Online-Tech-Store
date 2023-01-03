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
       
    $smartphone = Product::where('category_id', 1)->where('id',2)->get();
    $tablets = Product::where('category_id', 2)->take(1)->orderby('id')->get();
    $computers = Product::where('category_id', 3)->where('id',12)->get();
    $accessories = Product::where('category_id', 4)->where('id',15)->get();
    $best1 = Product::where('category_id', 1)->where('id',1)->get();
    $best2 = Product::where('category_id', 4)->where('id',14)->get();
    $best3 = Product::where('category_id', 3)->where('id',10)->get();
    $best4= Product::where('category_id', 1)->where('id',5)->get();
    
    return view('pages.home',[
        'smartphone' => $smartphone,
        'computers' => $computers,
        'accessories' => $accessories,
        'tablets' => $tablets,
        'best1' => $best1,
        'best2' => $best2,
        'best3' => $best3,
        'best4' => $best4,
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
