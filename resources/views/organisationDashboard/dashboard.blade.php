@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/organisationDashboardApp.js') }}" defer></script>
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container" id="organisation-dashboard">
    <h1>{{__('Organisation :')}} {{ $organisation->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Projects:')}}</h2>
            <div id="projects-container">
              @foreach($projects as $project)
                <organisation-dashboard-project name="{{$project->name}}"
                  v-bind:tasks-to-do="['test1', 'test2', 'test3']"
                  button-text="{{ __('See the project') }}"
                  uri-project="https://github.com"
                ></organisation-dashboard-project>
              @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Users:')}}</h2>
            <div id="users-container">
              @foreach($users as $user)
                <organisation-dashboard-user name="{{$user->name}}"
                  v-bind:tasks="{{$tasks[$user->email]}}">
                </organisation-dashboard-user>
              @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
