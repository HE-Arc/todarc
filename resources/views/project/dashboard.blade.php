@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/projectDashboardApp.js') }}" defer></script>
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container" id="project-dashboard">
    <div class="row">
        <div class="col-md-12">
            <project-dashboard name="{{$project->name}}"
                v-bind:tasks-to-do="['test1', 'test2', 'test3']"
            ></project-dashboard>
        </div>
    </div>
</div>
@endsection
