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

    //Base routes
    Route::get('/', 'UserDashboard@dashboard')->name('home');
    Route::get('/home', 'UserDashboard@dashboard')->name('home');

    //Projects
    Route::resource('projects', 'ProjectController')->except(['store']);
    Route::resource('projects.labels', 'LabelController')->except(['show', 'create', 'edit']);
    Route::resource('projects.tasks.labels', 'TaskLabelController')->only(['store', 'destroy']);
    Route::resource('projects.tasks-hierarchy', 'ProjectTaskHierarchyController')->only(['store']);
    Route::resource('projects.groups-hierarchy', 'ProjectGroupHierarchyController')->only(['store']);

    //Création of projects
    Route::resource('users.projects', 'UserProjectController')->only(['store']);
    Route::resource('organisations.projects', 'OrganisationProjectController')->only(['store']);

    //Creation of organisation
    Route::resource('organisations', 'OrganisationController')->only(['show', 'store']);

    //TODO Add to api routes
    Route::resource('users', 'JsonUserController')->only(['index']);
    Route::resource('tasks', 'JsonTaskController')->only(['update', 'destroy']);
    Route::resource('groups', 'JsonGroupController')->only(['update', 'destroy']);
    Route::resource('projects.tasks', 'JsonProjectTaskController')->only(['index', 'store', 'destroy']);
    Route::resource('projects.groups', 'JsonProjectGroupController')->only(['index', 'store']);
    Route::resource('organisations.users', 'JsonOrganisationUserController')->only(['store', 'destroy']);
});

Auth::routes();
