<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class OverviewController extends Controller
{
    public function dashboard ()
    {	
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	return view('bruker.student.dashboard', [
	    		'brukerinfo' => $brukerinfo
			]);
    	}

    	else if ($brukerinfo->bruker_type == "bedrift") {
    		return view('bruker.bedrift.dashboard', [
				'brukerinfo' => $brukerinfo
			]);
    	}

    }
}
