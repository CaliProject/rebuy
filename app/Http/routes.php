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

Route::group([
    'prefix' => 'manage',
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::get('{section?}', 'ManageController@index');
});