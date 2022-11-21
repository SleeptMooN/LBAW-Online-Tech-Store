@extends('users.index')

@section('contentprofile')

    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session()->get('status') }}
        </div>
    @endif

    <div class="col-md-8">
        <form method="post" action="{{ route('users.edit') }}">
            @csrf

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 d-flex row align-content-center">
                            <h6 class="mb-0 ">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 d-flex row align-content-center">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3 d-flex row align-content-center">
                            <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}">
                        </div>                 
                    </div>
                    <hr>
                    <div class="row">

                        <div class="d-grid gap-2 d-md-block">
                            <a href="/users" class="btn btn-danger" role="button">Cancel</a>
                            <input type="submit" name="send" value="Update" class="btn btn-success ">
                            {{-- <a type="submit" class="btn btn-success" role="button">Update</a> --}}
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
