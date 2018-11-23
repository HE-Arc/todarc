@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <div class="row">
        <div class="col-md-8">
            <project-dashboard v-bind:project='{!! $project->toJson(); !!}' v-bind:groups='{!! $groups->toJson() !!}' v-bind:tasks='{!! $tasks->toJson() !!}' ></project-dashboard>
        </div>
        <div class="col-md-4">
            <project-summary owner="{{ $project->owner->name }}"></project-summary>
        </div>
    </div>
</div>
@endsection
