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

      <div class="row">
        <div class="col-md-9">
          <h2>{{ __('Projects') }}</h2>
        </div>
        <div class="col-md-3 text-right">
          <add-new-project
          button-text="{{__('+ New project')}}"
          :owner-id="{{ $organisation->id }}"
          owner-type="organisations"
          ></add-new-project>
        </div>
      </div>

      <div id="projects-container" class="cards-container">
          @foreach($projects as $project)
          <organisation-dashboard-project name="{{$project->name}}"
          :project-id="{{ $project->id }}"
          :tasks-to-do="{{$project->tasksNameJson()}}"
          button-text="{{ __('See the project') }}"
          uri-project="https://github.com"
          ></organisation-dashboard-project>
          @endforeach
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-9">
          <h2>{{ __('Users') }}</h2>
        </div>
        <div class="col-md-3 text-right">
          <add-existing-user
          :users=@json($users)
          :organisation='{!! $organisation->toJson(); !!}'
          ></add-existing-user>
        </div>
      </div>
      <div id="users-container" class="cards-container">
          @foreach($users as $user)
          <organisation-dashboard-user
          :user="{{ $user->toJson() }}"
          :organisation='{!! $organisation->toJson(); !!}'
          ></organisation-dashboard-user>
          @endforeach
      </div>
    </div>
  </div>
</div>

@endsection
