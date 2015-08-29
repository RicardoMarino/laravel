<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middlawere' => 'oauth'], function() {
    Route::resource('client', 'ClientController', ['exception' => ['created', 'edit']]);
    Route::resource('project', 'ProjectController', ['exception' => ['created', 'edit']]);
    Route::group(['prefix' => 'project'], function () {

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note/', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');
    });
});

