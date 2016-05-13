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

Route::get('@{name}', 'ProfileController@show');

Route::get('posts', 'PostsController@posts');
Route::get('videos', 'PostsController@videos');
Route::get('markets', 'MarketsController@index');
Route::get('search/{keyword}', 'HomeController@search');

Route::put('comments/like/{comment}', 'PostsController@likeComment');

Route::get('tag/{type}/{tag}', 'HomeController@showTag');

Route::group([
    'prefix' => 'posts/{post}.html'
], function () {
    Route::get('/', 'PostsController@show');
    Route::patch('/', 'PostsController@likePost');
    
    Route::post('comment', 'PostsController@comment');
    Route::post('comments/{page}', 'PostsController@loadMoreComments');
});

Route::group([
    'prefix' => 'markets/products/{product}.html'
], function () {
    Route::get('/', 'MarketsController@show');
});

Route::post('upload', 'HomeController@uploadPicture');
Route::post('upload/avatar', 'HomeController@uploadAvatar');

Route::group([
    'prefix' => 'profile',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'ProfileController@index');
    Route::patch('/', 'ProfileController@updateProfile');
});

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
    
    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('create', 'ManageController@showCreateUser');
        Route::post('create', 'ManageController@createUser');
        Route::get('{user}', 'ManageController@showEditUser');
        Route::patch('{user}', 'ManageController@updateUser');
        Route::delete('{user}', 'ManageController@deleteUser');
    });
    
    Route::group([
        'prefix' => 'comments'
    ], function () {
        Route::delete('{comment}', 'ManageController@deleteComment');
    });
    
    Route::group([
        'prefix' => 'media'
    ], function () {
        Route::delete('{media}', 'ManageController@deleteMedia');
    });

    Route::group([
        'prefix' => 'markets'
    ], function () {
        Route::get('create', 'ManageController@showCreateProduct');
        Route::post('create', 'ManageController@createProduct');
        Route::get('{product}', 'ManageController@showEditProduct');
        Route::patch('{product}', 'ManageController@updateProduct');
        Route::delete('{product}', 'ManageController@deleteProduct');
    });
    
    Route::patch('extras', 'ManageController@updateExtra');
});