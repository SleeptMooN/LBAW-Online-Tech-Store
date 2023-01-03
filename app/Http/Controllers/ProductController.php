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
        Flash::success('Product added to cart successfully!');
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

    private function apiCall(string $fileData){
        $curl = curl_init();

        $fileDataBase64 = base64_encode($fileData);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.imgbb.com/1/upload?expiration=600&key=a50845146859254b33ca26c70d1a43e0',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('image' => $fileDataBase64),
        ));

        $response = curl_exec($curl);

        $responseData = json_decode($response);

        curl_close($curl);
        return $responseData->data->display_url;
    }

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
        }

    public function addToDB(Request $request) {
        $image_data = file_get_contents($request->image);
        $apiCall = $this->apiCall($image_data);
        $userId = Auth::id();
        if ($userId == null) {
            return redirect('/login'); 
        }

        $maxId = DB::table('product')->max('id');
        $newId = $maxId + 1;

        $product = [
            "id" => $newId,
            "name" => $request->title,
            "price" => $request->price,
            "description" => $request->description,
            "quantity" => $request->quantity,
            "score" => 5,
            "photo" => $apiCall,
            "category_id" => $request->category
        ];
        
        DB::table('product')->insert($product);
        return redirect('/');
    }

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
