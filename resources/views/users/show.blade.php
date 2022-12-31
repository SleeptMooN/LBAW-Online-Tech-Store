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
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ url('/users/edit') }}" class="btn btn-outline-dark btn-lg" role="button">Edit</a>
                      </div>
                </div>
            </div>
        </div>


    </div>
@endsection
