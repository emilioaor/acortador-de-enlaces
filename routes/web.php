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

/** Route Index */
Route::get('/', ['uses' => 'IndexController@index', 'as' => 'index.index', 'middleware' => 'redirectIfAuth']);
Route::post('/login', ['uses' => 'IndexController@login', 'as' => 'index.login', 'middleware' => 'redirectIfAuth']);
Route::get('/register', ['uses' => 'IndexController@register', 'as' => 'index.register', 'middleware' => 'redirectIfAuth']);
Route::post('/register-user', ['uses' => 'IndexController@registerUser', 'as' => 'index.registerUser', 'middleware' => 'redirectIfAuth']);
Route::get('/logout', ['uses' => 'IndexController@logout', 'as' => 'index.logout']);
Route::get('/{short}', ['uses' => 'IndexController@visit', 'as' => 'index.visit']);

/** Route Login User */
Route::group(['prefix' => 'user', 'middleware' => 'user'], function() {
    Route::resource('/link', 'LinkController');
    Route::get('/link/graphic/{userId}', ['uses' => 'LinkController@generalGraphic', 'as' => 'link.graphic.general']);
    Route::get('/link/graphic/{userId}/{linkId}', ['uses' => 'LinkController@linkGraphic', 'as' => 'link.graphic.link']);
});
