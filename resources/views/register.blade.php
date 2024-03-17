@extends('components/main')

@section('title', 'Register')

@section('style-container')

  @vite('resources/register/js/jquery.min.js')

  @vite('resources/register/css/style.css')

  @vite('resources/register/fonts/material-icon/css/material-design-iconic-font.min.css')

@endsection


@section('main-content')

    <!-- Sign up form -->
    <section style="margin-top: 10px;" class="signup">
        <div style="width: 40%" class="container">
            <div class="signup-content">
                <div style="width: 100%" class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form action="{{ route('register.register') }}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="re_pass" placeholder="Confirm password"/>
                        </div>
                        @if($errors->any())
                            @foreach($errors->all() as $single_error)
                              <span style="font-size: 18px; color: indianred; margin-top: 18px"> {{ $single_error }} </span>
                            @endforeach
                        @endif
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                        <div class="form-group form-button text-center">
                            <a href="{{ route('login.index') }}" class="signup-image-link">I am already member</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
