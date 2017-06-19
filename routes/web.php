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

//-- Authentication Routes --//
//==========================//
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/auth/logout', 'Auth\LoginController@logout');

Route::get('/login', function () {
    return view('layouts.auth.login');
})->name('login');

//-- Admin Routes --//
//==========================//

//Route::group(['prefix' => 'admin'], function () {
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('projects', 'ProjectsController@index');

    Route::get('promotions', function() {
        return view('admin.promotions.index');
        // Matches The "/admin/promotions" URL
    });
    Route::get('environments', function() {
        return view('admin.environments.index');
        // Matches The "/admin/environments" URL
    });
    Route::get('support', function() {
        return view('admin.support.index');
        // Matches The "/admin/support" URL
    });
    Route::get('users', function() {
        return view('admin.users.index');
        // Matches The "/admin/users" URL
    });

    //-- Project Routes --//
    //==========================//
    Route::get('project/create', 'ProjectsController@create');

    Route::get('project/edit/{id}', function() {

    });
});

//-- Main Routes --//
//=======================//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('environments.index');
    });

    Route::get('/projects', 'ProjectsController@show');

    Route::get('/promotions', function() {
        return view('promotions.index');
    });

    Route::get('/environments', function() {
        return view('environments.index');
    });

    Route::get('/support', function() {
        return view('support.index');
    });

    //-- Ticket Routes --//
    //=======================//
    Route::get('/tickets/new', function() {
        return view('support.tickets.new');
    });

    Route::get('/tickets/open', function() {
        return view('tickets.open');
    });

    Route::get('/tickets/closed', function() {
        return view('tickets.closed');
    });

    //-- User Routes --//
    //=======================//
    Route::post('/users/create', 'UserController@create');

    //-- Notification Routes --//
    //=======================//
    Route::get('/notifications/all', 'NotificationsController@index');



    //-- Test Routes --//
    //=======================//
    Route::get('/environments/down', 'EnvironmentsController@environmentDown');
});