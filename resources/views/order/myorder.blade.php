@extends('layouts.app')


@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                     <h2 class="text-white"> Order 
                        <a href="{{url('orders')}}" class="btn btn-warning text-white float-end mt-1">Back</a>
                     </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            
                            <label for="">Name</label>
                            <div class="border">{{ $orders->name}}</div>
                            <label for="">Email</label>
                            <div class="border">{{ $orders->email}}</div>
                            <label for="">Phone</label>
                            <div class="border">{{ $orders->phone}}</div>
                        </div>
                        <div class="col-md-6">
                        <h4>Order Details</h4>
                        <table class="table table-bordered">
                          <thead> 
                              <tr>
                                  <th>Product Name</th>
                                  <th>Quantity Purchased</th>
                                  <th>Price</th>
                                  <th>Image</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach ($orders->purchase as $item)
                        <tr>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->totalcost * $item->quantity }} €</td>
                            <td>
                                <img src="{{$item->product->photo}}" width="50px" alt="Product Image">
                            </td>      
                        </tr>

                        @endforeach
                              
                          </tbody>
          
                        </table>
                        <h4>Total Price: {{ $orders->totalcost}} €</h4>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>

    </div>

</div>

@endsection