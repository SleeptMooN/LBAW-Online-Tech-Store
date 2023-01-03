@component('components.addProduct')
@endcomponent

@extends('layouts.app')

@section('content')

{{-- Start Carousel section --}}
<section class="mb-3">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <a href="/">
                    <img src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/n/v/nvidia_holidays22_d.jpg" class="d-block w-100 " alt="failed loading image"></img>
                </a>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <a href="/product/16">
                        <img src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/n/v/nvidia_holidays22_d.jpg"  
                          class="d-block w-100 " alt="failed loading image"></img>
                    </a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <a href="/product/17">
                        <img src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/p/o/portateis_lenovo_thinkpad_d.jpg"
                            class="d-block w-100 " alt="failed loading image">
                    </a>
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <a href="/product/12">
                        <img src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/l/e/lenovo_legion_xmas_d.jpg"
                            class="d-block w-100" alt="failed loading image">
                    </a>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <a href="/product/12">
                    <img src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/l/e/lenovo_legion_xmas_d.jpg" class="d-block w-100" alt="failed loading image">
                </a>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</section>
{{-- End Carousel section --}}

{{-- Start Products --}}
<section class="mb-4">
    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">

        <h1><span class="badge bg-warning">Featured Products</span></h1>
        @auth
        @if (Auth::user()->is_admin)
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal" style="height: 50px">
            <i class='fas fa-plus' style='font-size:24px '></i>
            Add Product
        </button>
            @endif
            @endauth
    </div>
    <div class="card text-center">
        <p>
        <div class="container ">
            <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">

                @if ($smartphone->count() != 0)
                @foreach ($smartphone as $item)
                <div class="col">
                    @include('components.productCard', ['item' => $item])
                </div>

                @endforeach
                @endif
                @if ($tablets->count() != 0)
                    @foreach ($tablets as $item)
                    <div class="col">
                        @include('components.productCard', ['item' => $item])
                    </div>

                    @endforeach
                @endif
                @if ($computers->count() != 0)
                    @foreach ($computers as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>
                    @endforeach
                @endif
                @if ($accessories->count() != 0)
                    @foreach ($accessories as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>
                    </div>
                    <p>
</section>
{{----------------------------------------------------------------------------------------------}}
{{-- End Products --}}
                    @endforeach
                @endif
                </div>
        </div>
        
        <p>
    </section>
    {{----------------------------------------------------------------------------------------------}}
    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <a href="/product/9">
                <img class="d-block w-100" src="https://static.pcdiga.com/media/Skrey_Slideshow/Slide_Image/m/a/macbook_pro_banner_d.jpg" alt="First slide">
           </a>
            </div>
    </div>
  </div>
  <section class="mb-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4 mt-4">
        
            <h1><span class="badge bg-warning">Best sellers</span></h1>
        </div>
    
        <div class="card text-center">
 
        <p>
        <div class="container ">        
            <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
                
                @if ($best1->count() != 0)
                    @foreach ($best1 as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>

                    @endforeach
                @endif
                @if ($best2->count() != 0)
                    @foreach ($best2 as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>

                    @endforeach
                @endif
                @if ($best3->count() != 0)
                    @foreach ($best3 as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>

                    @endforeach
                @endif
                @if ($best4->count() != 0)
                    @foreach ($best4 as $item)
                        <div class="col">
                            @include('components.productCard', ['item' => $item])
                        </div>

                    @endforeach
                @endif
            
                </div>
        </div>
        
        <p>
    </section>
@endsection