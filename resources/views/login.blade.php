@extends('components/main')

@section('title', 'Login')

@section('main-navbar')
  @parent
@endsection

<head>
  @vite('resources/login/css/main.css')
  @vite('resources/login/js/main.js')
</head>

@section('main-content')
  <div class="login-container">

    <form method="POST" action="{{ route('login.login') }}" class="was-validated">
      @csrf
      <div class="error-container">
          @if($errors->any())
              @foreach($errors->all() as $single_error)
                  <div class="alert alert-danger" role="alert">
                      <span style="width: 95%; display: inline-block"> {{ $single_error }} </span>
                      <button style="float: right" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endforeach
          @endif
      </div>


      <div class="mb-3">
        <label for="validationTextarea" class="form-label">Email</label>
        <input name="email" class="form-control" type="email" id="validationTextarea" placeholder="Email" required>
        <div class="invalid-feedback">
          Please enter a Username.
        </div>
      </div>

      <div class="mb-3">
        <label for="validationTextarea" class="form-label">Password</label>
        <input name="password" class="form-control" type="password" id="validationTextarea" placeholder="Password" required>
        <div class="invalid-feedback">
          Please enter a password.
        </div>
      </div>

      <div class="mb-3 text-center">
        <button class="btn btn-success" type="submit">Login</button>
      </div>

    </form>
  </div>
@endsection
