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

                                @foreach ($cartItems as $items)
                                    <tr>
                                        <td class="d-flex align-content-center flex-wrap">
                                            <div>
                                                <a href="/product/{{ $items->id }}" class="title text-dark"
                                                    data-abc="true">
                                                    {{ $items->name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('card.updateItem') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $items->id }}" name="id">
                                                <input type="number" value="{{ $items->quantity }}" name="newQuantity">
                                            </form>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">
                                                    {{ $items->price * $items->quantity }}€
                                                </var>
                                                <small class="text-muted">
                                                    {{ $items->price }}€ each
                                                </small>
                                            </div>
                                        </td>
                                        <form action="{{ route('card.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $items->id }}" name="id">
                                            <td class="text-right d-none d-md-block">
                                                <button type="submit" name="send" class="btn btn-danger" data-abc="true">
                                                    Remove
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @if ($cartItems->count() == 0)

                                    @else
                                        <form action="{{ route('card.clear') }}" method="POST">
                                            @csrf
                                            <td class="text-right d-none d-md-block">
                                                <button type="submit" name="send" class="btn btn-danger" data-abc="true">
                                                    Clear Cart
                                                </button>
                                            </td>
                                        </form>
                                    @endif
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right ml-3">
                                {{ $total }} €
                            </dd>
                        </dl>
                        <a href="{{ url()->previous() }}" class="btn btn-out btn-success btn-square btn-main mt-2"
                            data-abc="true">Continue
                            Shopping</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>

@endsection

