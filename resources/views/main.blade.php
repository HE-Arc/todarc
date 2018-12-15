

@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('content')
<div id="main-page" class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">What is TODARC ?</div>
            <div class="card-body">
               <p>This web application allow managing todo lists. Users can manage their own list of tasks for each one of their projects.
                  Users can create some organisations to work in team inside a unique entity. It's possible to create a project inside an organisation and all members of this team can edit it.
               </p>
               <p>The usage of this amazing tools, required you be registered. If you have already created your account, you can <a class="btn btn-outline-success" href="login">log in</a>.
                  If you're still not register down't wait and <a class="btn btn-outline-success" href="register">Register now</a>
               </p>
            </div>
         </div>
      </div>
   </div>
   <div class="pt-3 row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">Functionalities</div>
            <div class="card-body">
               <p>ToD'Arc offers you the following functionalities:/p>
               <ul>
                  <li>Create/remove an organisation</li>
                  <li>Create/remove project linked to a user or an organisation</li>
                  <li>Manage members or and organisation</li>
                  <li>Manage task for each project (name of the task, responsible, start time, due to date, etc...)</li>
                  <li>Labels management for project</li>
                  <li>Labels attribution to tasks</li>
                  <li>Hierarchical organisation of tasks and groups of tasks</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="pt-3 row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">TODARC in pictures</div>
            <div class="card-body">
               <img alt="Project-Dashboard" src="{{ asset('images/Project-Tasks.png') }}" class="centered-img"></img>
               <img alt="User-Dashboard" src="{{ asset('images/User-Dashboard.png') }}" class="centered-img"></img>
               <img alt="Organisation-Dashboard" src="{{ asset('images/Organisation-Dashboard.png') }}" class="centered-img"></img>
            </div>
         </div>
      </div>
   </div>
   <div class="pt-3 row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">About</div>
            <div class="card-body">
               <p>This web application has been developed during the 2018 autumn semester at "HE-Arc Ingénierie" of "Neuchâtel" as part of the course of web development.</p>
               <p>People having contributed to this amazing project are:</p>
               <ul>
                  <li><a href="https://github.com/Asmoday4949">Fleury Malik</a></li>
                  <li><a href="https://github.com/bull0n">Bulloni Lucas</a></li>
                  <li><a href="https://github.com/Ph0tonic/">Wermeille Bastien</a></li>
               </ul>
            </div>
         </div>
         <div class="pt-3 row justify-content-center">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">Contribute</div>
                  <div class="card-body">
                     <p>This web application is an open source project and your contributions are welcome.</p>
                     <p>Please visite our <a href="https://github.com/HE-Arc/todarc">Github repo</a>.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

