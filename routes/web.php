<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PageController@hjem');
Route::get('bruker', 'BrukerController@bruker')->middleware('auth');

Route::group(['middleware' => ['web']], function() {
	Route::resource('web', 'updateUserController');
});

//Route::get('bruker/rediger', 'updateUserController@index')->middleware('auth');

// Route::get('bruker/{bruker}', 'BrukerController@seBruker')->middleware('auth');

//Route::post('bruker/oppdater', 'updateUserController@update');

Auth::routes();