@extends('layouts.app')

@section('content')

<div class="container mt-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
            <h1>WishList</h1>
        </div>
        
            <div class="container my-5">
                <div class="card shadow">
                    @if($wishlist->count() > 0)
                    <div class="table-responsive p-3">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col" width="300">Image</th>
                                    <th scope="col" width="500">Product</th>
                                    <th scope="col" class="text-right d-none d-md-block"></th>
                                </tr>
                            </thead>
                        
                        </table>
                           
                            @foreach ($wishlist as $items)       
                            <div class="row product_data mt-3 mb-3 ">
                                <div class="col-md-2 mt-4">
                                <img src="{{ $items->products->photo }}" height="80px" width="80px" class="img-fluid" 
                                             alt="error loading image" onclick="location.href='/product/{{ $items->product_id }}'" style="cursor: pointer;">

                                </div> 
                                <div class="col-md-6 my-auto">
                                    <h3> {{ $items->products->name }} </h3>
                                </div> 
                                
                             
                                <input type="hidden" value= "{{$items->product_id}}" class="prod_id">
							
							<div class="col-md-2 my-auto">
                                 <button  class="btn btn-dark addToCart_WL mt-3"> Add to Cart </button>
                            </div>
                             
                             <div class="col-md-2 my-auto">
                                 <button  class="btn btn-danger wishlist-remove-btn mt-3"> Remove </button>
                            </div>
                         </div> 
                        @endforeach
                    </div>   
                </div>   
            </div>
            @else
                <div class="card-body text-center">
                    <h2> WishList Empty!</h2>
                    <a href="{{ url('/') }}" class="btn btn-outline-dark"> Continue shopping</a>

                </div>
            @endif
        </div>
    </div>

@endsection

