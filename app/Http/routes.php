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


Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/success', 'HomeController@success');

Route::group(['prefix' => 'admin'], function() {
    Route::delete('/categories/{id}', 'CategoryController@delete');
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories/create', 'CategoryController@postCreate');
    Route::get('/categories/{id}', 'CategoryController@update');
    Route::patch('/categories/{id}', 'CategoryController@patchUpdate');
    Route::get('/categories', 'CategoryController@index');
    Route::patch('/categories/{id}', 'CategoryController@patchUpdate');
});
