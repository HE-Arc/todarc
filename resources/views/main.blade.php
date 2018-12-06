@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TODARC</div>

                <div class="card-body">
                  <h4>A propos</h4>
                  <p>Cette application a été développée durant le semestre d'automne 2018 à la HE-Arc Ingénierie de Neuchâtel, dans le cadre du cours de développement web.</p>
                  <ul>
              			<li>M. Bastien Wermeille</li>
              			<li>M. Lucas Bulloni</li>
              			<li>M. Malik Fleury</li>
              		</ul>

                  <h4>Qu'est-ce que TODARC ?</h4>
                  <p>C'est une applicaton web permettant de gérer des todos list. Les utilisateurs peuvent gérer la liste des tâches à faire pour chacun de leurs projets.
                  Les utilisateurs peuvent être regroupés au sein du même entité (organisation) qui correspond à tous les membres travaillant sur le(s) projet(s) de cette entité.</p>

                  <h4>Fonctionnalités<h4>
                  <p>Notre application comporte les fonctionnalités suivantes :</p>
                  <ul>
                    <li>Ajout/suppression d'organisation</li>
                    <li>Ajout/suppression de projet lié à un utilisateur ou une organisation</li>
                    <li>Ajout/éjection de membre au sein d'une organisation</li>
                    <li>Gestion de tâches de projet (nom de la tâche, personne responsable, dates, etc...)</li>
                    <li>Ajout de gestion des labels</li>
                    <li></li>
                    <li></li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
