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
Route::group(['prefix' => 'v1'], function() {

    //-- Projects --//
    Route::get('/projects', function() {
        return App\Project::withCount('comments')->orderBy('id', 'asc')->get();
    });

    //-- Project Routes --//
    Route::group(['prefix' => 'project'], function() {
        Route::put('/update/{id}', 'ProjectController@update');
        Route::get('/delete/{id}', 'ProjectController@delete');

        //-- Comments for projects --//
        Route::get('/{id}/comments', function($id) {
            return App\Comment::with('user')->where('project_id', $id)->get();
        });
    });

    Route::put('/comment/update/{id}', 'CommentController@update');

    //-- Users --//
    Route::get('/users', function() {
        return App\User::all();
    });

    //-- User Routes --//
    Route::group(['prefix' => 'user'], function() {
        Route::post('/create', 'UserController@create');
        Route::get('/notifications/{id}', 'NotificationsController@getUnreadNotifications');
        Route::put('/update/{id}', 'UserController@update');
        Route::get('/delete/{id}', 'UserController@delete');
    });


//    Route::get('/users/notifications/{id}/read', 'NotificationsController@getNotifications');

    //-- Tickets --//
    Route::get('/tickets/view/all', 'TicketsController@viewTickets');


    //-- Control Routes --//
    Route::group(['prefix' => 'controls'], function() {
        Route::get('/project-status', function() {
            return App\ProjectStatus::all();
        });

        Route::get('/manager/{type}', function($type) {
            return App\User::Manager($type);
        });
    });

});
