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

  Route::resource('projects', 'ProjectController');

  Route::resource('groups', 'JsonGroupsController')->except([
    'create', 'index', 'store'
  ]);

  Route::resource('projects.tasks', 'JsonProjectTaskController')->only([
    'index', 'create', 'store'
  ]);

  Route::resource('projects.groups', 'JsonProjectGroupController')->only([
    'index', 'create', 'store'
  ]);

  Route::get('/', 'UserDashboard@dashboard')->name('home');
  Route::get('/home', 'UserDashboard@dashboard')->name('home');
  Route::get('/organisation/{organisationName}', 'OrganisationController@dashboard');
  Route::post('/storeProjectOrg/{organisationName}', 'ProjectController@storeForOrganisation');
  Route::post('/storeProject', 'ProjectController@store');

});

Auth::routes();
