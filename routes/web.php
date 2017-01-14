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
Route::get('innboks', 'InnboksController@seMeldinger')->middleware('auth');

// User routes
Route::patch('bruker/{user}', 'UserEditController@updateUser');
Route::get('bruker/rediger', 'UserEditController@index')->middleware('auth');

Route::get('bruker/{bruker}', 'UserHomeController@seBruker')->middleware('auth');
Route::get('bruker', 'UserHomeController@bruker')->middleware('auth');

// Upload Routes
Route::post('bruker/uploads/forsidebilde', 'UploadController@uploadForsidebilde');
Route::post('bruker/uploads/profilbilde', 'UploadController@uploadProfilbilde');

// Delete Routes
Route::delete('bruker/rediger/forsidebilde/{user}', 'UserEditController@deleteFrontImg');
Route::delete('bruker/rediger/profilbilde/{user}', 'UserEditController@deleteProfilImg');

// Ajax calls
Route::get('ajax/sort/list', 'Ajax\SortController@sortList');
Route::get('ajax/sort/cards', 'Ajax\SortController@sortCards');

// Confirm User
Route::get('bekreft/{token}', 'Auth\RegisterController@ConfirmEmail');

// Auth routes (such as login, register etc)
Auth::routes();