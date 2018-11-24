<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'checklogin'], function() {

  Route::resource('projects', 'ProjectController')->except(['store']);
  Route::resource('users.projects', 'UserProjectController')->only(['store']);
  Route::resource('organisations.projects', 'OrganisationProjectController')->only(['store']);
  Route::resource('organisations', 'OrganisationController')->only(['show', 'store']);
  Route::resource('projects.labels', 'LabelController')->except(['show', 'create', 'edit']);

  Route::get('/', 'UserDashboard@dashboard')->name('home');
  Route::get('/home', 'UserDashboard@dashboard')->name('home');

  Route::resource('projects.groups-hierarchy', 'ProjectGroupHierarchyController')->only(['store']);
  Route::resource('projects.tasks-hierarchy', 'ProjectTaskHierarchyController')->only(['store']);

  //TODO add following routes to api
  Route::resource('groups', 'JsonGroupController')->only([
    'update', 'destroy'
  ]);
  Route::resource('tasks', 'JsonTaskController')->only([
    'update', 'destroy'
  ]);

  Route::resource('projects.tasks', 'JsonProjectTaskController')->only([
    'index', 'store'
  ]);

  Route::resource('projects.groups', 'JsonProjectGroupController')->only([
    'index', 'store'
  ]);

  Route::resource('organisations.users', 'JsonOrganisationUserController')->only([
    'store', 'destroy'
  ]);

  Route::resource('users', 'JsonUserController')->only(['index']);
});

Auth::routes();
