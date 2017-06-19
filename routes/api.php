<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//-- Project Routes --//
//=======================//
//Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
Route::group(['prefix' => 'v1'], function(){
    //-- Projects --//
    Route::get('/projects', function() {
        return App\Projects::orderBy('created_at', 'desc')->get();
    });

    Route::put('/projects/update/{id}', 'ProjectsController@update');

    //-- Users --//
    Route::get('/users', function() {
        return App\User::all();
    });

    Route::post('/users/create', 'UserController@create');
});
