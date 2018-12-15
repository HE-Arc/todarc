@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/userDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="user-dashboard">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-6">
          <h2>{{ __('Projects') }}</h2>
        </div>
        <div class="col-sm-6 text-right">
          <add-new-project
          button-text="{{__('+ New project')}}"
          :owner-id="{{ $user->id }}"
          owner-type="users"
          ></add-new-project>
        </div>
      </div>

      @if(!$projects->isEmpty())
        <div class="cards-container">
          @foreach($projects as $project)
            <user-dashboard-project name="{{ $project->name }}"
              :tasks-to-do="{{ $project->tasksName()->toJson() }}"
              button-text="{{ __('See the project') }}"
              uri-project="{{ $project->url }}"
              ></user-dashboard-project>
          @endforeach
        </div>
      @else
        <div class="alert alert-danger center-alert" align="middle">You don't have any projects.</div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-6">
          <h2>{{ __('Organisation') }}</h2>
        </div>
        <div class="col-sm-6 text-right">
        <add-new-org button-text="{{__('+ New organisation')}}" :user-id="{{ $user->id }}"></add-new-org>
        </div>
      </div>

      @if(!$organisations->isEmpty())
        <div class="cards-container">
          @foreach($organisations as $organisation)
          <user-dashboard-organisation
            name="{{$organisation->name}}"
            :projects="{{ $organisation->projects }}"
            button-text="{{ __('See the organisation') }}"
            uri-organisation="{{ url('/organisations/'.$organisation->name) }}"
            ></user-dashboard-organisation>
          @endforeach
        </div>
      @else
        <div class="alert alert-danger center-alert" align="middle">You're not yet a member of an organisation.</div>
      @endif
    </div>
  </div>
</div>
@endsection
