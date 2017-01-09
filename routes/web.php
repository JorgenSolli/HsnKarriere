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
Route::get('bruker/rediger', 'UserController@index')->middleware('auth');
Route::get('bruker/{bruker}', 'BrukerController@seBruker')->middleware('auth');
Route::get('innboks', 'InnboksController@seMeldinger')->middleware('auth');

// Update a user
Route::patch('bruker/{user}', 'UserController@updateUser');


// Upload something
Route::post('bruker/uploads/forsidebilde', 'UploadController@uploadForsidebilde');
Route::post('bruker/uploads/profilbilde', 'UploadController@uploadProfilbilde');

Auth::routes();