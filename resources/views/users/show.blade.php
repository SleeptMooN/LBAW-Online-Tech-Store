@extends('users.index')

@section('contentprofile')

<div class="col-md-8">

    <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 d-flex row align-content-center">
                        <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->name }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3 d-flex row align-content-center">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->email }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3 d-flex row align-content-center">
                        <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->phone }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3 d-flex row align-content-center">
                        <h6 class="mb-0">Credits</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::user()->credits }} €
                    </div>
                </div>
                
               
                <hr>
                <div class="row">
                    <div class="d-grid d-md-block">
                        <a href="{{ url('/users/edit') }}" class="btn btn-outline-warning btn-lg" role="button">Edit</a>
                        <a href="{{ url('/orders') }}" class="btn btn-dark btn-lg" role="button">Purchases historic</a>
                        <a href="{{ url('/logout') }}" class="btn btn-outline-danger btn-lg" role="button">Logout</a>
                        <form method="GET" action="{{ url('/deleteUser') }}">
                        <input class="btn btn-danger btn-lg float-end" type="submit" value="Delete Account"></form>
                      </div>
                    
                
                </div>
            </div>
        </div>


    </div>
@endsection
