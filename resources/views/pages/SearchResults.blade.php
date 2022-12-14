@extends('layouts.app')

@section('content')

<section>
    <ul class="col-md-4 col-lg-12">
        @if(!$products->isEmpty())
    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
        <div class="order-md-2 col-lg-8 mt-4">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-6 col-md-6 col-lg-3 mb-3">
                            {{-- start card --}}
                            @include('components.productCard', ['item' => $item])
                            {{-- end card --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
        @endif

        @if($products -> isEmpty())
        <div class=" mt-4">
            <h2 style="text-align:center; font-weight:bold;"> Sorry, we couldn't find this product!</h2> 
            </div>
        @endif

    </ul>
</section>


@endsection