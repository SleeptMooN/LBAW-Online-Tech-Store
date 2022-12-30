@extends('layouts.app')


@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            @if(!$orders->isEmpty())
                <div class="card-header bg-dark">
                     <h2 class="text-white"> My orders</h2>
                </div>
                <div class="card-body">
                     <table class="table table-bordered">
                     <thead> 
                         <tr>
                             <th>Order Date</th>
                             <th>Tracking number</th>
                             <th>Total price</th>
                             <th>Status</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($orders as $items)
                             <tr>
                                 <td>{{ date('d-m-y',strtotime($items->orderdate)) }}</td>
                                 <td>{{$items->trackingnumber}}</td>
                                 <td>{{$items->totalcost}} €</td>
                                 <td>{{$items->status}}</td>
                                 <td>
                                     <a href="{{ url('view-order/'.$items->id) }} " class="btn btn-dark "> view</a>
                                 </td>
     
                             </tr>
     
                         @endforeach
                     </tbody>
     
                  </table>
                </div>
                @else
                <div class="card-body text-center">
                    <h2> No purchases made yet! </h2>
                    <a href="{{ url('/') }}" class="btn btn-outline-dark"> Continue shopping</a>

                </div>
                @endif
            </div>         
        </div>
    </div>
</div>

@endsection