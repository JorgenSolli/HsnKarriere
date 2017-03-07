<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Partnership;
use App\User;

class UploadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
    * Updates the user headerimage
    *
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

    /**
    * Updates the contract for a partnership
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadContract (Partnership $partnership, Request $request) {

        if ($partnership->student_id == Auth::id()) {
            // Gets file, uplads it, and store the path and filename
            $file = request()->file('kontrakt');
            $path = $file->store('uploads/kontrakter/signert');

            $partnership->kontrakt = $path;
            $partnership->save();
            return back()->with('success', 'Kontrakten ble lastet opp.');
        }

        return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
    }
}