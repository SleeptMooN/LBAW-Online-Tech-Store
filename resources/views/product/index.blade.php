@extends('layouts.app')

@section('content')

    <div class="container">
        <main class="mt-5 pt-4 product_data">
            <div class="container mt-2">

                <div class="row wow fadeIn">
                    <div class="col-md-6 mb-4">
                        <div class="box">
                        <img src="{{ $product->photo }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">

                        <div class="p-4">
                            <h1>{{ $product->name }}</h1>

                            <div class="card mt-4" style="width: 30rem;">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Card title</h5> --}}
                                    <h6 class="card-subtitle mb-2 text-muted">Specifications</h6>
                                    <p class="card-text">
                                        {{ $product->description }}
                                    </p>

                                </div>
                            </div>
                            <div class="d-flex justify-content-left gap-3">
                            <div class="card mb-4 mt-4" style="width: 6.5rem;">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Price</h6>
                                    <p class="card-text">
                                        {{ $product->price }} € 
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-4 mt-4" style="width: 6.5rem;">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Score</h6>
                                    <p class="card-text">
                                        {{ $product->score }} ★
                                    </p>
                                </div>
                            </div>
                            </div>

                        <div class="d-flex justify-content-left gap-3">  
                                  <input type="hidden" value= "{{$product->id}}" class="prod_id">                         
                                  <div class="input-group" style="width:130px">
                                      <button class="btn btn-dark input-group-text dec_btn ">-</button>
                                      <input id="qty" type="text" class="form-control text-center bg-white input-qty" value="1" disabled>
                                      <button class="btn btn-dark input-group-text add_btn">+</button>

                                  </div>
                           
                                <input type="hidden" value="{{ $product->id }}" name="id">

                                <button class="btn btn-dark addToCartBtn" type="submit" name="send" > add to cart
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                        <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg> 
                                   
                                </button>
                          
                            
                                
                                <input type="hidden" id = "m" value="{{ $product->id }}" name="id">

                                <button class="btn btn-warning addToWishBtn " type="submit" name="send">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                </button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </main>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4 pl-1">
            <h1>Reviews</h1>
        </div>

        @if(!$reviews->isEmpty())
            <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="card shadow-0 border" style="background-color: #adb5bd;">
                    <div class="card-body p-4">

                        @foreach ($reviews as $items)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h4 style=" font-weight:bold">{{ $items->title }} </h4>
                                    <p class="text-muted"> {{ $items->comment }}</p>

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <p class="medium mb-0  "> {{ $items->users->name }},</p>
                                            <p class="small mb-0 ms-1 text-muted">
                                                {{ $items->date->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="d-flex flex-row align-items-center ">
                                            <h5 style=" font-weight:bold;" class="medium mb-0">{{ $items->score }} ★ </h5>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($reviews -> isEmpty())
        <div class=" mt-4">
            <h2 style="text-align:center; font-weight:bold;"> This product has no reviews yet!</h2> 
        </div>
        @endif
        @if (Auth::check()) 
   
        <h4 class=" mt-4"style="text-align:center; font-weight:bold;"> Write your review</h4> 

    @if (session('message'))
         <div class="alert alert-success text-center">
        {{ session('message') }}
        </div>
    <script>
        let alert = document.querySelector('.alert');

      
        setTimeout(function() {
          alert.remove();
        }, 3000);
    </script>
    @endif
                <div class="mx-auto">
                  <ul class="" style="list-style-type: none; padding-left: 0px;">
                      <li class="mb-3">
                          <div class="d-grid p-2 rounded-top rounded-bottom" style="background-color:  #f2f7fa;">
                            <textarea class="text form-control mb-3"  rows ="1" name="title" form="reviewForm" placeholder="Enter Title" required autofocus></textarea>
                            <textarea class="text form-control mb-3"  rows ="3" name="reviewText" form="reviewForm" placeholder="Write the review" required autofocus></textarea>
                            <form method="POST" class="add_review align-items-center" id="reviewForm" name="reviewForm" action="{{ route('addreview') }}">
                              {{ csrf_field() }}
                              <label for="rating">Rating:</label>
                              <input style="margin-right: 1em;" type="number" id="rating" name="rating" step="0.1" min="0.1" max="5" required autofocus>
                              <input name="id_product" value="{{ $product->id }}" hidden required>
                              <input  class="btn btn-outline-warning " type="submit" name="submitReview" value="Submit Review">
                            </form>
                            @else
                            <h4 style="text-align:center; font-weight:bold;">Login to post a review!</h4>  
                         
                            @endif
                          </div>
                        
                      </li>
                  </ul>
                </div>
            </div>

    </div>

@endsection