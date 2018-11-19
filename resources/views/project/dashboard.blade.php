@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <div class="row">
        <div class="col-md-12">
            <project-dashboard v-bind:project='{!! $project->toJson(); !!}' v-bind:groups='{!! $groups->toJson() !!}' v-bind:tasks='{!! $tasks->toJson() !!}' ></project-dashboard>
        </div>
    </div>
</div>
@endsection
