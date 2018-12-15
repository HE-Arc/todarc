@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div id="main-page" class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Qu'est-ce que TODARC ?</div>
                <div class="card-body">
                  <p>C'est une applicaton web permettant de gérer des todos list. Les utilisateurs peuvent gérer la liste des tâches à faire pour chacun de leurs projets.
                  Les utilisateurs peuvent être regroupés au sein d'une même entité (organisation) qui correspond à tous les membres travaillant sur le(s) projet(s) de cette entité.</p>
                  @if (!Auth::check())
                    <p>Pour avoir accès à cet outil, il est nécessaire de se loguer au site. Si vous avez déjà un compte, vous pouvez vous loguer <a href="login">ici.</a>. Si vous n'avez pas encore de compte,
                      il est possible de s'inscrire:</p>
                    <a class="btn btn-outline-success" href="register">Register</a>
                    <a class="btn btn-outline-success" href="login">Connect</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="pt-3 row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Fonctionnalités</div>
                <div class="card-body">
                  <p>Notre application comporte les fonctionnalités suivantes :</p>
                  <ul>
                    <li>Ajout/suppression d'organisations</li>
                    <li>Ajout/suppression de projet lié à un utilisateur ou une organisation</li>
                    <li>Ajout/éjection de membre au sein d'une organisation</li>
                    <li>Gestion de tâches de projet (nom de la tâche, personne responsable, dates de début et de fin, etc...)</li>
                    <li>Attribution de labels sur les tâches</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="pt-3 row justify-content-center">
            <div class="col-md-12">
              <div class="card">

                <div class="card-header">TODARC en images</div>
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

                <div class="card-header">A Propos</div>
                <div class="card-body">
                    <p>Cette application a été développée durant le semestre d'automne 2018 à la HE-Arc Ingénierie de Neuchâtel, dans le cadre du cours de développement web.</p>
                    <p>Les personnes ayant contribué au projet sont:</p>
                    <ul>
                      <li>M. Bastien Wermeille</li>
                      <li>M. Lucas Bulloni</li>
                      <li>M. Malik Fleury</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
