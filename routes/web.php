<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'PageController@hjem');

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

// Bedrift Jobs logic
Route::post('bruker/addJob/{user}', 'BedriftController@addJob');
Route::get('bruker/seeJob/{jobId}', 'BedriftController@seeJob');
Route::patch('bruker/editJob/{job}', 'BedriftController@editJob');
Route::get('bruker/destroyJob/{job}', 'BedriftController@destroyJob');

// Bedrift Master logic
Route::post('bruker/addMaster/{user}', 'BedriftController@addMaster');
Route::get('bruker/seeMaster/{assignmentId}', 'BedriftController@seeMaster');
Route::patch('bruker/editMaster/{assignment}','BedriftController@editMaster');
Route::get('bruker/destroyMaster/{assignment}', 'BedriftController@destroyMaster');

// Bedrift Bachelor logic
Route::post('bruker/addBachelor/{user}', 'BedriftController@addBachelor');
Route::get('bruker/seeBachelor/{assignmentId}', 'BedriftController@seeBachelor');
Route::patch('bruker/editBachelor/{assignment}', 'BedriftController@editBachelor');
Route::get('bruker/destroyBachelor/{assignment}', 'BedriftController@destroyBachelor');

// Messages
Route::get('innboks', 'InnboksController@seMeldinger')->middleware('auth');
Route::get('innboks/newMessage', 'InnboksController@newMessage');
Route::post('innboks/sendMessage', 'InnboksController@sendMessage');
Route::get('innboks/seeMessage/{message}', 'InnboksController@seeMessage');

// Ajax calls
Route::get('ajax/sort/list', 'Ajax\SortController@sortList');
Route::get('ajax/sort/cards', 'Ajax\SortController@sortCards');

// Confirm User
Route::get('bekreft/{token}', 'Auth\RegisterController@ConfirmEmail');

// Auth routes (such as login, register etc)
Auth::routes();