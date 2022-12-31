@extends('layouts.app')


@section('content')
    <div class="container mt-5">
    <form action="{{url('place-order')}}" method="POST">
                {{ csrf_field() }}
        <div class="row">
            @if($cartitems->count() > 0)
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6> Basic Details </h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="FirstName">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label for="FirstName"> Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email"required autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Phone Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter phone number"required autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> House Number</label>
                                <input type="text" class="form-control" name="house" placeholder="Enter house number"required autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> City</label>
                                <input type="text" class="form-control" name="city" placeholder="Enter City"required autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Postal Code</label>
                                <input type="text" class="form-control"  name="postal" placeholder="Enter postal code"required autofocus>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Country</label>
                                <input type="text" class="form-control"  name="country" placeholder="Enter Country"required autofocus>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6> Order Details </h6>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Quantity</th>
                                    <th> Price </th>

                                </tr>
                            </thead>
                            <tbody> 
                                @php $total = 0; @endphp
                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->product->price * $item->quantity}} €</td>
                                </tr>
                                
                                @php $total += $item->product->price * $item->quantity ; @endphp
                                @endforeach
                                
                            </tbody>
                        </table>
                        <h4>Your Credits = {{$item->users->credits}} €</h4>
                        <h5> Total Order Price = {{ $total }} €</h5>
                        <h6> Credits after the purchase = {{ $item->users->credits - $total }} €</h6>
                        <hr>
                        @if($item->users->credits > $total)
                        @php $item->users->credits = $item->users->credits - $total;@endphp
                        <button type ="submit" class="btn btn-dark w-100">Place Order</button>
                        @else
                        <a href="{{ url('/users/edit') }}" class="btn btn-outline-dark w-100"> Add Credits</a>
                        @endif

                    </div>
                </div>
                @else
                <div class="card-body text-center">
                    <h2> No products added to cart, theres nothing to buy! </h2>
                    <a href="{{ url('/') }}" class="btn btn-outline-dark"> Continue shopping</a>

                </div>
            @endif
            </div>
        </div>
        </form>
    </div>
@endsection