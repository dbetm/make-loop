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

Route::get('/', function() {
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


    Route::delete('/users/{id}', 'UserController@delete');
    Route::patch('/users/{id}', 'UserController@turned');
    Route::get('/users', 'UserController@index');
    Route::put('/users/{id}', 'UserController@disban');
});

Route::delete('/articles/{id}', 'ArticleController@delete');
Route::get('/articles/index', 'ArticleController@index');
Route::get('/articles/create', 'ArticleController@create');
Route::post('/articles/create', 'ArticleController@postCreate');
Route::get('/articles/{id}', 'ArticleController@update');
Route::patch('/articles/{id}', 'ArticleController@patchUpdate');
Route::put('/articles/{id}', 'ArticleController@turned');
