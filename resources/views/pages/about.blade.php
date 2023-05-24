@extends('layouts.app')

@section('content')
  <div class="container my-5">

    <h1 class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">About</h1>
    <hr>

    <section class="py-3">
      <div class="row">
        <div class="col-md-6">
          <h2>About OnlyT3ch</h2>
          <p>Welcome to our online tech store! We are a team who strive to provide our customers with the best selection of the latest and greatest technology products at competitive prices. Our goal is to make it easy for you to find and purchase the products you need to stay connected and productive.</p>
          <p>In our store, you will find a wide range of products including laptops, smartphones and tablets. We also offer a range of accessories to help you get the most out of your tech.</p>
          <p>We are committed to providing excellent customer service and support. Thank you for choosing our store, and we hope to see you again soon!</p>
        </div>
        <div class="col-md-6">
          <img class="img-fluid" src="/img/about.webp" alt="OnlyT3ch" style="width: 20rem;">
        </div>
      </div>
    </section>

    <section class="pb-3">
      <h2 class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">Our Team</h2>
      <hr>
      <div class="row text-center py-3">
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card text-center" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">António Pedro Cabral dos Santos</h5>
              <p class="card-text">up201907156@up.pt</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card" style="width: 17rem;">
            <div class="card-body">
              <h5 class="card-title">João Margato Borlido Pereira</h5>
              <p class="card-text">up201907007@up.pt</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Miguel Ângelo Pacheco Valente</h5>
              <p class="card-text">up201704608@up.pt</p>
            </div>
          </div>
        </div>
      </div>

     
    </section>
  </div>
@endsection
