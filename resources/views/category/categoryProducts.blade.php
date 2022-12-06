@extends('layouts.app')

@section('content')
<section>
    <div class="container">

        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
            <h1>{{ $category->name }}</h1>
        </div>

        <h3 class="mt-0 mb-5">Showing <span class="text-primary">{{ $products->count() }}</span> Products</h3>

        <div class="col-md-8 order-md-2 col-lg-12">
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
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>

    </div>
</section>
@endsection
