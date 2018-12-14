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
    Route::get('/', 'UserDashboard@dashboard')->name('home'); // changes if not logged in
    Route::get('/home', 'UserDashboard@dashboard')->name('home');

    //Projects
    Route::group(['middleware' => 'project.rights'], function(){
        Route::resource('projects', 'ProjectController')->except(['store', 'edit', 'update']);
        Route::resource('projects.tasks', 'ProjectTaskController')->only(['index', 'update', 'store', 'destroy']);
        Route::resource('projects.tasks.labels', 'ProjectTaskLabelController')->only(['destroy']);
        Route::resource('projects.tasks-hierarchy', 'ProjectTaskHierarchyController')->only(['store']);
        Route::resource('projects.labels', 'ProjectLabelController')->except(['show', 'create', 'edit']);
        Route::resource('projects.groups', 'ProjectGroupController')->only(['index', 'update', 'store', 'destroy']);
        Route::resource('projects.groups-hierarchy', 'ProjectGroupHierarchyController')->only(['store']);
    });

    //Users
    Route::resource('users', 'UserController')->only(['index']);
    Route::resource('users.projects', 'UserProjectController')->only(['store']);

    //Creation of organisation
    Route::resource('organisations', 'OrganisationController')->only(['show', 'store']);
    Route::group(['middleware' => 'organisation.member'], function(){
        Route::resource('organisations.users', 'OrganisationUserController')->only(['store', 'destroy']);
        Route::resource('organisations.projects', 'OrganisationProjectController')->only(['store']);
    });
});

Route::get('/about', 'MainController@index')->name('about');

Auth::routes();
