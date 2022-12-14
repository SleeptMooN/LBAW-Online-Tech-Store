@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="mt-5 pt-4">
            <div class="container mt-2">

                <div class="row wow fadeIn">

                    <div class="col-md-6 mb-4">

                        <img src="{{ $product->photo }}" class="img-fluid" alt="">

                    </div>

                    <div class="col-md-6 mb-4">

                        <div class="p-4">
                            <h1>{{ $product->name }}</h1>

                            <div class="card mt-4" style="width: 30rem;">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Card title</h5> --}}
                                    <h6 class="card-subtitle mb-2 text-muted">Description</h6>
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
                                  <div class="input-group" style="width:130px">
                                      <button class="btn btn-dark input-group-text">-</button>
                                      <input type="text" class="form-control text-center bg-white" value="1" disabled>
                                      <button class="btn btn-dark input-group-text">+</button>
                                  </div>
                            <form  action="{{ route('card.add') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id">

                                <button class="btn btn-dark" type="submit" name="send">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                        <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg> 
                                   
                                </button>
                            </form>
                            
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id">

                                <button class="btn btn-warning" type="submit" name="send">
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
            <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        {{-- <div class="form-outline mb-4">
                            <input type="text" id="addANote" class="form-control" placeholder="Type comment..." />
                            <div class="mt-1">   
                            <label class="form-label" for="addANote">Score</label>

                            <input style="width: 80px" class="col-xs-2" type="number" value="1" min="1" max="10" name="newQuantity">
                        </div> --}}

                        @foreach ($reviews as $items)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5>{{ $items->title }}</h5>
                                    <p class="text-muted"> {{ $items->comment }}</p>

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">

                                            <p class="small mb-0 ms-2">{{ $username->name }}</p>
                                        </div>
                                        <div class="d-flex flex-row align-items-center text-primary">
                                            <p class="small mb-0">{{ $items->score }}</p>
                                            <p class="small mb-0">/5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                        <div class="d-flex justify-content-center mt-4">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

  


    </div>
@endsection