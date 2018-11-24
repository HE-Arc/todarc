@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <project-dashboard
      v-bind:project='{!! $project->toJson(); !!}'
      v-bind:groups='{!! $groups->toJson() !!}'
      v-bind:tasks='{!! $tasks->toJson() !!}'
      v-bind:labels-input="{{$labels->toJson()}}"
    ></project-dashboard>
</div>
@endsection
