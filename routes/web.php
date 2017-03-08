<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'PageController@hjem');

// Notification AJAX call
Route::get('notification', 'NotificationController@notification');
Route::get('notification/check', 'NotificationController@check');

// User Oversikt/Overview/dashboard
Route::get('oversikt', 'DashboardController@dashboard');

// Dashboard ajax calls for teachers
Route::get('oversikt/{type}', 'DashboardController@getSpecificData');

// User routes
Route::patch('bruker/{user}', 'UserEditController@updateUser');
Route::get('bruker/rediger', 'UserEditController@index');
Route::get('bruker/{bruker}', 'UserHomeController@seBruker');
Route::get('bruker', 'UserHomeController@bruker');

// Upload Routes
Route::post('bruker/uploads/forsidebilde', 'UploadController@uploadForsidebilde');
Route::post('bruker/uploads/profilbilde', 'UploadController@uploadProfilbilde');
Route::post('oversikt/uploads/kontrakt/{partnership}', 'UploadController@uploadContract');
Route::post('/oversikt/uploads/arbeidsbeskrivelse/{partnership}', 'UploadController@uploadJobDescription');

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
Route::get('bruker/seeMaster/{assignment}', 'BedriftController@seeMaster');
Route::patch('bruker/editMaster/{assignment}','BedriftController@editMaster');
Route::get('bruker/destroyMaster/{assignment}', 'BedriftController@destroyMaster');

// Bedrift Bachelor logic
Route::post('bruker/addBachelor/{user}', 'BedriftController@addBachelor');
Route::get('bruker/seeBachelor/{assignmentId}', 'BedriftController@seeBachelor');
Route::patch('bruker/editBachelor/{assignment}', 'BedriftController@editBachelor');
Route::get('bruker/destroyBachelor/{assignment}', 'BedriftController@destroyBachelor');

// Messages
Route::get('innboks', 'InnboksController@listMessages');
Route::get('innboks/newMessage', 'InnboksController@newMessage');
Route::post('innboks/sendNewMessage', 'InnboksController@sendNewMessage');
Route::post('innboks/sendMessage', 'InnboksController@replyMessage');
Route::get('innboks/seeMessage/{message}', 'InnboksController@seeMessage');
Route::post('innboks/replyMessage/{message}', 'InnboksController@replyMessage');
Route::post('innboks/addUser/{message}', 'InnboksController@addUser');

// Partnerships
Route::post('samarbeid/nyttSamarbeid', 'SamarbeidController@nyttSamarbeid');
Route::post('godkjennSamarbeid/{partnership}', 'SamarbeidController@godkjennSamarbeid');
Route::delete('samarbeid/{partnership}', 'SamarbeidController@slettSamarbeid');

// Ajax calls
Route::get('users/showUsers/{display}', 'Ajax\SortController@showUsers');
Route::get('innboks/findUsers/{message}', 'Ajax\getUsers@listUsers');

// Confirm User
Route::get('bekreft/{token}', 'Auth\RegisterController@ConfirmEmail');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// Auth routes (such as login, register etc)
Auth::routes();
