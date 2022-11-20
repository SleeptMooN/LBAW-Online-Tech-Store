@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
            <h1>{{ $product->name }}</h1>
        </div> --}}




        <main class="mt-5 pt-4">
            <div class="container mt-2">

                <div class="row wow fadeIn">

                    <div class="col-md-6 mb-4">

                        <img src="{{ $product->photo }}" class="img-fluid" alt="">

                    </div>

                    <div class="col-md-6 mb-4">

                        <!--Content-->
                        <div class="p-4">
                            <h1>{{ $product->name }}</h1>

                            <div class="card mb-4 mt-4" style="width: 20rem;">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Card title</h5> --}}
                                    <h6 class="card-subtitle mb-2 text-muted">Description</h6>
                                    <p class="card-text">
                                        {{ $product->description }}
                                    </p>

                                </div>
                            </div>

                            {{-- <p class="lead font-weight-bold">Description</p> --}}

                            {{-- <p>
                                    {{ $product->description }}
                                </p> --}}
                        <div class="d-flex justify-content-left gap-3">



                            <form  action="{{ route('card.add') }}"
                                method="POST">
                                <!-- Default input -->
                                @csrf

                                <input type="hidden" value="{{ $product->id }}" name="id">

                                <input type="number" value="1" class="form-control" style="width: 100px" name="quantity">
                                <button class="btn btn-primary btn-md my-0 p " type="submit">Add to cart
                                    <i class="fas fa-shopping-cart ml-1"></i>
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
                        <!--Content-->

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <hr>

            </div>
        </main>
        <!--Main layout-->



        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4 pl-1">
            <h1>Reviews</h1>

    </div>
@endsection
