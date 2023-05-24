<?php

namespace App\Http\Controllers;
use Flash;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;

use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{

    public function index(){
        $old_cartitems = Cart::where('users_id',Auth::id())->get();
        foreach($old_cartitems as $items){
            if(!Product::where('id', $items->product_id)->where('quantity','>=',$items->quantity)->exists()){
                $removeItem = Cart::where('users_id',Auth::id())->where('product_id',$items->product_id)->first();
                $removeItem -> delete();
            }
        }
        $cartitems = Cart::where('users_id',Auth::id())->get();
        return view('checkout.order',compact('cartitems'));
        
    }

    public function placeorder(Request $request){


        $request->validate([
            'name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|int',
            'house' => 'required|int',
            'postal' => 'required|int',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);


        $order = new Order();
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->trackingnumber = rand(1111,99999);
        $order-> save();

        $address = new Address();
        $address->housenumber = $request->input('house');
        $address->postalcode = $request->input('postal');
        $address->city = $request->input('city');
        $address->country = $request->input('country');
        $address->users_id = Auth::id();
        $address->save();


        $cartitems = Cart::where('users_id',Auth::id())->get();
        foreach($cartitems as $item){
            Purchase::create([
                'order_id'=>$order->id,
                'product_id'=>$item->product_id,
                'quantity'=>$item->quantity,
                'totalcost'=>$item->product->price,
            ]);

            $product = Product::where('id',$item->product_id)->first();
            $product->update();
            
        } 

        $total=0;
        $cartitems_total = Cart::where('users_id',Auth::id())->get();
        foreach($cartitems_total as $prod){
            $total += $prod->product->price * $prod->quantity ;
        }
        $order->totalcost = $total;
        $order->users_id = Auth::id();
        $order-> save();

        $cartitems = Cart::where('users_id',Auth::id())->get();
        Cart::destroy($cartitems); 

        Flash::success('Order placed Successfully!');
        $user = User::find(Auth::id());
        $user->update([
         'credits' => $user->credits - $total,
        ]);

        return redirect('/orders')->with('message', 'Successful purchase!');
    }

    public function showorders(){

        $orders = Order::where('users_id',Auth::id())->get();
        return view('order.orders',compact('orders'));
    }

    public function vieworder($id){
        
        $address = Address::where('users_id',Auth::id())->get();
        $orders = Order::where('id',$id)->where('users_id',Auth::id())->first();
        return view('order.myorder',compact('orders','address'));

    }
    
}
