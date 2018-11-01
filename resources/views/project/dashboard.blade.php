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
            @foreach ($group as $groups())
                {{$group->name}}
            @endforeach
            {{

            }}
            <project-dashboard project={!! json_encode($project) !!} groups={!! json_encode($project->groups()) !!}></project-dashboard>
        </div>
    </div>
</div>
@endsection
