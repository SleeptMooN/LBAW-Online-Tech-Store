@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
            <h1>Shopping Cart</h1>
        </div>
        <div class="row">
            <aside class="col-lg-9">

                
                <div class="card">
                    <div class="table-responsive p-3">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">

                                <tr class="small text-uppercase">
                                    <th scope="col" width="300">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="250">Price</th>
                                    <th scope="col" class="text-right d-none d-md-block"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>

                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total: {{ $total }} $</dt>
                            
                        </dl>
 
                      </div>
                </div>
            </aside>
        </div>
    </div>

@endsection
