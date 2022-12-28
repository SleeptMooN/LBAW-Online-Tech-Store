@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6> Basic Details </h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="FirstName">Name</label>
                                <input type="text" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="col-md-6">
                                <label for="FirstName"> Email</label>
                                <input type="text" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Phone Number</label>
                                <input type="text" class="form-control" placeholder="Enter phone number">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> House Number</label>
                                <input type="text" class="form-control" placeholder="Enter house number">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> City</label>
                                <input type="text" class="form-control" placeholder="Enter City">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Postal Code</label>
                                <input type="text" class="form-control" placeholder="Enter postal code">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="FirstName"> Country</label>
                                <input type="text" class="form-control" placeholder="Enter Country">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6> order Details </h6>
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
                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->product->price * $item->quantity}} €</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <hr>
                        <button class="btn btn-dark float-end">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection