@extends('layouts.app')

@section('scripts')
  <script type="application/javascript">
    var _project = @json($project);
    var _groups = @json($groups);
    var _tasks = @json($tasks);
    var _labelsInput = @json($labels);
  </script>
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <project-dashboard
      :project='_project'
      :groups='_groups'
      :tasks='_tasks'
      :labels-input='_labelsInput'
    ></project-dashboard>
</div>
@endsection
