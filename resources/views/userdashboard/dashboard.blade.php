@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/userDashboardApp.js') }}" defer></script>
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Projects</h2>
            <div>
              <p> blabla</p>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h2>Organisations</h2>
        <div>baba</div>
      </div>
    </div>
</div>
@endsection
