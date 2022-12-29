@extends('layouts.app')


@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <h4> My orders</h4>
                </div>
                <div class="card-body">
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
                    @foreach ($orders as $items)
                        <tr>
                            <td>{{$items->trackingnumber}}</td>
                            <td>{{$items->totalcost}}</td>
                            <td>{{$items->status}}</td>
                            <td>
                                <a href="{{ url('view-order/'.$items->id) }} " class="btn btn-dark"> view</a>
                            </td>

                        </tr>

                    @endforeach
                </tbody>

            </table>
                </div>
            </div>
            
            
        </div>

    </div>

</div>

@endsection