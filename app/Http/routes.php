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


Route::auth();

Route::get('/', 'HomeController@index');

Route::get('posts', function () {
    
});

Route::get('markets', function () {

});

Route::get('posts/{post}.html', 'HomeController@showPost');

Route::post('upload', 'HomeController@uploadPicture');

Route::group([
    'prefix' => 'manage',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('{section?}', 'ManageController@index');
    
    Route::group([
        'prefix' => 'posts'
    ], function () {
        Route::get('create', 'ManageController@showCreatePost');
        Route::post('create', 'ManageController@createPost');
        Route::get('{post}', 'ManageController@showEditPost');
        Route::patch('{post}', 'ManageController@updatePost');
        Route::delete('{post}', 'ManageController@deletePost');
    });
});