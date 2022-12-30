@extends('layouts.app')


@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <h4> Order</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <div class="border p-2">{{ $orders->name}}</div>
                            <label for="">Email</label>
                            <div class="border p-2">{{ $orders->email}}</div>
                            <label for="">Phone</label>
                            <div class="border p-2">{{ $orders->phone}}</div>
                            @foreach ($address as $items)
                            <label for="">Country</label>
                            <div class="border p-2">{{ $items->country}}</div>
                            <label for="">City</label>
                            <div class="border p-2">{{ $items->city}}</div>
                            <label for="">House number</label>
                            <div class="border p-2">{{ $items->housenumber}}</div>
                            <label for="">Postal code</label>
                            <div class="border p-2">{{ $items->postalcode}}</div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                        <table class="table table-bordered">
                          <thead> 
                              <tr>
                                  <th>Tracking number</th>
                                  <th>Total price</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                         
                              
                          </tbody>
          
                      </table>
                        </div>
                    </div>
                
                </div>
            </div>
            
            
        </div>

    </div>

</div>

@endsection