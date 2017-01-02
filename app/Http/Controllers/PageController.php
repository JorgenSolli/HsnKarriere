<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageController extends Controller {
	public function hjem() {

		if (Auth::guest()) {
			return view('hjemGuest');
		} else {
			$avatar = Auth::user()->profilbilde;
			return view('hjemAuth', 
				[
					'avatar' => $avatar
				]);
		}
	}
}