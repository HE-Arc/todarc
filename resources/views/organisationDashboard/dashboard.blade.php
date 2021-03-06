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
        <div class="col-sm-6">
          <h2>{{ __('Projects') }}</h2>
        </div>
        <div class="col-sm-6 text-right">
          <add-new-project
          button-text="{{__('+ New project')}}"
          :owner-id="{{ $organisation->id }}"
          owner-type="organisations"
          ></add-new-project>
        </div>
      </div>

      @if(!$projects->isEmpty())
        <div id="projects-container" class="cards-container">
            @foreach($projects as $project)
            <organisation-dashboard-project name="{{ $project->name }}"
            :project-id="{{ $project->id }}"
            :tasks-to-do="{{ $project->tasksName()->toJson() }}"
            button-text="{{ __('See the project') }}"
            uri-project="https://github.com"
            ></organisation-dashboard-project>
            @endforeach
        </div>
      @else
        <div class="alert alert-danger center-alert" align="middle">This organisation does not have any project.</div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-6">
          <h2>{{ __('Users') }}</h2>
        </div>
        <div class="col-sm-6 text-right">
          <add-existing-user
          :users="{{ $user->toJson() }}"
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
