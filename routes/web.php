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
  Route::resource('projects', 'UserProjectController')->only(['store']); //TODO Change route name to users.projects
  Route::resource('organisations.projects', 'OrganisationProjectController')->only(['store']);
  Route::resource('organisations', 'OrganisationController')->only(['show']);


  //TODO add folowing routes to api
  Route::resource('groups', 'JsonGroupController')->only([
    'update', 'destroy'
  ]);

  Route::resource('projects.tasks', 'JsonProjectTaskController')->only([
    'index', 'store'
  ]);

  Route::resource('projects.groups', 'JsonProjectGroupController')->only([
    'index', 'store'
  ]);

  Route::get('/', 'UserDashboard@dashboard')->name('home');
  Route::get('/home', 'UserDashboard@dashboard')->name('home');
  Route::get('/organisation/{organisationName}', 'OrganisationController@index');

});

Auth::routes();
