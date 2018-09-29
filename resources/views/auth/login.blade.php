@extends('layouts.app-loggedout')

@section('content')
<div class="form-signin" >
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <h1 class="h3 mb-3 font-weight-normal">{{ __('Login') }}</h1>

    <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
    <input type="email" id="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" required autofocus>

    <label for="password" class="sr-only">{{ __('Password') }}</label>
    <input type="password" id="password" class="form-control" placeholder="{{ __('Password') }}" required>

    <div class="custom-control custom-checkbox mb-3">
      <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
      <label class="custom-control-label" for="remember">
         {{ __('Remember Me') }}
      </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>

    <div class="text-right">
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
  </div>
  </form>
</div>
@endsection
