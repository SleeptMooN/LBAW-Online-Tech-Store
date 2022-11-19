@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="main-body mt-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-4">
                <h1>Profile</h1>
            </div>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @yield('contentprofile')
                
                
            </div>

        </div>
    </div>

@endsection
