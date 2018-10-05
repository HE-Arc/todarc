@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/loginApp.js') }}" defer></script>
@endsection

@section('content')
<div class="form-signin container" id="login-form">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post" action="{{ route('login') }}" v-on:submit.prevent="submit">
        @csrf

        <h1 class="h3 mb-3 font-weight-normal">{{ __('Login') }}</h1>

        <div class="alert alert-danger" role="alert" v-show="!valid">
          {{ __('The email or password is not correct.') }}
        </div>

        <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
        <input type="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" v-model="email" required autofocus>

        <label for="password" class="sr-only">{{ __('Password') }}</label>
        <input type="password" id="password" class="form-control" placeholder="{{ __('Password') }}" v-model="password" required>

        <div class="custom-control custom-checkbox mb-3">
          <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} v-model="remember">
          <label class="custom-control-label" for="remember">
             {{ __('Remember Me') }}
          </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>

        <div class="text-right">
          <a href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
          -
          <a href="{{ route('register') }}">
            {{ __('Register') }}
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
