@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/userDashboardApp.js') }}" defer></script>
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container" id="user-dashboard">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ __('Projects') }}</h2>
            <div id="projects-container">
              <user-dashboard-project name="Hello"
                v-bind:tasks-to-do="['test1', 'test2', 'test3']"
                button-text="{{ __('See the project') }}"
                uri-project="https://github.com"
              ></user-dashboard-project>
              <user-dashboard-project name="Salut"></user-dashboard-project>
              <user-dashboard-project name="hallo"></user-dashboard-project>
              <user-dashboard-project name="Hello"></user-dashboard-project>
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
