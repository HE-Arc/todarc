<nav class="navbar navbar-expand-md navbar-dark bg-primary navbar-laravel">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('images/logo.bmp') }}" style="max-height: 50px; margin-bottom: -20px; margin-top: -30px;" alt="{{ config('app.name', 'ToDArc') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/about') }}">
            About
          </a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          <li class="nav-item">
            @if (Route::has('register'))
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
          </li>
        @else
          <li class="nav-item">
            <span class="navbar-text pr-3">
              Hi {{ Auth::user()->name }} !
            </span>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}"
              class="nav-link"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
