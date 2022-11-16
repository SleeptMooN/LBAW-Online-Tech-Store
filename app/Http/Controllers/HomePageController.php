<?php

namespace App\Http\Controllers;


class HomePageController extends Controller
{
  /**
   * Show the application home page.
   *
   */
  public function index()
  {
    return view('pages.home');
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
  public function services() {
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
