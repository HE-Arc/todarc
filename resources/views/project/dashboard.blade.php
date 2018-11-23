@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <div class="row">
        <div class="col-md-8">
            <project-dashboard
              v-bind:project='{!! $project->toJson(); !!}'
              v-bind:groups='{!! $groups->toJson() !!}'
              v-bind:tasks='{!! $tasks->toJson() !!}'
              v-on:tasks-changed="updateNbTasks"
            ></project-dashboard>
        </div>
        <div class="col-md-4">
            <project-summary
              owner="{{ $project->owner->name }}"
              v-bind:labels-input="{{$labels->toJson()}}"
              v-bind:nb-tasks-done="nbTasksDone"
              v-bind:nb-tasks-running="nbTasksRunning"
            ></project-summary>
        </div>
    </div>
</div>
@endsection
