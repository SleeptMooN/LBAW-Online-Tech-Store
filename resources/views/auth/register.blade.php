@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-4 offset-md-4">
          <div class="login-form bg-light mt-4 p-4">
              <form method="POST" action="{{ route('register') }}" class="row g-3">
                  {{ csrf_field() }}

                  <h3>Welcome</h4>
                  <div class="col-12">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                      <span class="error">
                          {{ $errors->first('name') }}
                      </span>
                    @endif
                  </div>
                  <div class="col-12">
                    <label for="email">E-Mail Address</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                      <span class="error">
                          {{ $errors->first('email') }}
                      </span>
                    @endif
                  </div>
                  <div class="col-12">
                    <label for="email">Phone</label>
                    <input id="email" class="form-control" type="phone" name="phone" value="{{ old('phone') }}" required>
                    @if ($errors->has('phone'))
                      <span class="error">
                          {{ $errors->first('phone') }}
                      </span>
                    @endif
                  </div>
                  <div class="col-12">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                    @if ($errors->has('password'))
                      <span class="error">
                          {{ $errors->first('password') }}
                      </span>
                    @endif
                  </div>
                  <div class="col-12">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                  </div>

                  <div class="col-12">
                      <button type="submit" class="btn btn-dark float-end">Sign up</button>
                  </div>
              </form>
              <hr class="mt-4">
              <div class="col-12">
                  <p class="text-center mb-0">Have an account? <a class="button button-outline"
                          href="{{ route('login') }}">Sign in</a></p>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

