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

  Route::get('/', 'UserDashboard@dashboard')->name('home');
  Route::get('/home', 'UserDashboard@dashboard')->name('home');
  Route::get('/organisation/{organisationName}', 'OrganisationController@index');
  Route::post('/storeProjectOrg/{organisationName}', 'ProjectController@storeForOrganisation');
  Route::post('/storeProject', 'ProjectController@store');

});

Auth::routes();
