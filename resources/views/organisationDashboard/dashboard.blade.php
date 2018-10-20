@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container" id="organisation-dashboard">
    <div class="row">
        <div class="col-md-12">
            <h2>Organisation: {{ $organisation->name }}</h2>
            <div id="projects-container">
              @foreach($users as $user)
                <p>{{ $user }}</p>
              @endforeach
              @foreach($projects as $project)
                <p>{{ $project }}</p>
              @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
