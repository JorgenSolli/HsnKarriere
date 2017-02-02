<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UploadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
    * Updates the user avatar
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $user (id)
    * @return \Illuminate\Http\Response
    */
    public function uploadForsidebilde () {

    	// Gets file, uplads it, and store the path and filename
    	$file = request()->file('forsidebilde');
		$path = $file->store('uploads/img/forsidebilder');

		$user = User::find(Auth::id());
		$user->forsidebilde = $path;
		$user->save();

    	return back();
    }

    /**
    * Updates the user avatar
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $user (id)
    * @return \Illuminate\Http\Response
    */
    public function uploadProfilbilde () {

    	// Gets file, uplads it, and store the path and filename
    	$file = request()->file('profilbilde');
		$path = $file->store('uploads/img/profilbilder');

		$user = User::find(Auth::id());
		$user->profilbilde = $path;
		$user->save();

    	return back();
    }
}