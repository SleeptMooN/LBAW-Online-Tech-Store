@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
            <h1>Shopping Cart</h1>
        </div>
        
            <div class="container my-5">
                <div class="card shadow">
                    <div class="table-responsive p-3">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" width="300">Image</th>
                                    <th scope="col" width="600">Product</th>
                                    <th scope="col" width="200">Quantity</th>
                                    <th scope="col" width="550">Price</th>
                                    <th scope="col" class="text-right d-none d-md-block"></th>
                                </tr>
                            </thead>
                        
                            @php $total = 0; @endphp
                            @foreach ($cartitems as $items)       
                         </table>
                            <div class="row product_data mt-3 mb-3 ">
                                <div class="col-md-2 mt-4">
                                <img src="{{ $items->product->photo }}" height="80px" width="80px" class="img-fluid" 
                                             alt="error loading image" onclick="location.href='/product/{{ $items->product_id }}'" style="cursor: pointer;">

                                </div> 
                                <div class="col-md-4 mt-4">
                                    <h3> {{ $items->product->name }} </h3>
                                </div> 
                             <div class="col-md-2 mt-4">  
                                <input type="hidden" value= "{{$items->product_id}}" class="prod_id">
                                                                                          
                                <div class="container mt-2 input-group" style="width:130px">
                                        <button class="btn btn-dark input-group-text changeQuantity dec_btn ">-</button>
                                        <input id="qty" type="text" class="form-control text-center bg-white input-qty" value="{{ $items->quantity }}" disabled>
                                        <button class="btn btn-dark input-group-text changeQuantity add_btn">+</button>
                                  </div>
                             </div>
                                <div class="col-md-2 mt-4">
                                                <div class="price">
                                                    {{ $items->product->price * $items->quantity }}€
                                                </div>
                                                <small class="text-muted">
                                                    {{ $items->product->price }}€ each
                                                </small>
                             </div>
                            
                             <div class="col mt-4">
                                <button  class="btn btn-danger delete-cart-item mt-3"> Remove </button>
                             </div>
                             @php $total += $items->product->price*$items->quantity ; @endphp
                         </div> 
                        @endforeach
                    </div>   
                    <div class="card-footer mt-3">
                        <h4> Total Price = {{ $total }} €
                            <button class="btn btn-dark float-end" > Proceed to checkout </button>
                        </h4>
                   </div>
                </div>   
            </div>
        </div>
    </div>


@endsection

