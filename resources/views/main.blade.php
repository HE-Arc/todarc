@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Qu'est-ce que TODARC ?</div>
                <div class="card-body">
                  <p>C'est une applicaton web permettant de gérer des todos list. Les utilisateurs peuvent gérer la liste des tâches à faire pour chacun de leurs projets.
                  Les utilisateurs peuvent être regroupés au sein d'une même entité (organisation) qui correspond à tous les membres travaillant sur le(s) projet(s) de cette entité.</p>
                </div>

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
