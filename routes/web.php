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

  Route::get('/projects/{$id}/groups', 'JsonProjectGroupController@index');
  Route::post('/projects/{$id}/groups/new', 'JsonProjectGroupController@create');
  Route::patch('/projects/{$id}/groups', 'JsonProjectGroupController@store');
  
  Route::resource('projects.tasks', 'JsonProjectTaskController')->only([
    'index', 'create', 'store'
  ]);
  
  Route::resource('projects.groups', 'JsonProjectGroupController')->only([
    'index', 'create', 'store'
  ]);

  Route::resource('projects', 'ProjectController');

  //Route::resource('groups', 'GroupsController');

  Route::get('/', 'UserDashboard@dashboard')->name('home');
  Route::get('/home', 'UserDashboard@dashboard')->name('home');
  Route::get('/organisation/{organisationName}', 'OrganisationController@index');
  
});

Auth::routes();
