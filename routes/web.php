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
Route::post('/register', 'Auth\RegisterController@create');

Route::get('/register/success', function () {
    return view('layouts.auth.registered');
})->name('registered');

Route::get('/login', function () {
    return view('layouts.auth.login');
})->name('login');

//-- Admin Routes --//
//==========================//

//Route::group(['prefix' => 'admin'], function () {
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('projects', 'ProjectController@index');

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
    Route::post('project/create', 'ProjectController@create');

    //-- Search Routes --//
    //=======================//
    Route::post('/comment/add', 'CommentController@create');




});

//-- Main Routes --//
//=======================//
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('environments.index');
    });

    Route::get('/projects', 'ProjectController@show');

    Route::get('/promotions', function() {
        return view('promotions.index');
    });

    Route::get('/environments', function() {
        return view('environments.index');
    });

    Route::get('/tickets', 'TicketsController@index');
    Route::get('/tickets/create', 'TicketsController@createTicket');

    //-- Ticket Routes --//
    //=======================//
//    Route::get('/tickets/new', function() {
//        return view('support.tickets.new');
//    });
//
//    Route::get('/tickets/open', function() {
//        return view('tickets.open');
//    });
//
//    Route::get('/tickets/closed', function() {
//        return view('tickets.closed');
//    });

    //-- User Routes --//
    //=======================//
    Route::post('/users/create', 'UserController@create');

    //-- Notification Routes --//
    //=======================//
    Route::get('/notifications/all', 'NotificationsController@index');
    Route::get('/notifications/{id}/read/{type}', 'NotificationsController@markAsRead');



    //-- Test Routes --//
    //=======================//
    Route::get('/environments/down', 'EnvironmentsController@environmentDown');
});