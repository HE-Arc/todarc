@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/registerApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <h1 class="h3 mb-3 font-weight-normal">{{ __('Register') }}</h1>
          <form method="POST" action="{{ route('register') }}" id="register-form" v-on:submit.prevent="submit">
            @csrf
            <div class="form-group">
              <label for="name" >{{ __('Name') }} *</label>
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}" v-bind="name">
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label for="email">{{ __('E-Mail Address') }} *</label>

              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}" v-bind="email">

              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group">
              <label for="password">{{ __('Password') }} *</label>

              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('Password') }}" v-bind="password">
              <small class="form-text text-muted">At least 6 charactersgit </small>

              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group">
              <label for="password-confirm">{{ __('Confirm Password') }} *</label>

              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}" v-bind="confirmPassword">
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary btn-lg">
                  {{ __('Register') }}
              </button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
