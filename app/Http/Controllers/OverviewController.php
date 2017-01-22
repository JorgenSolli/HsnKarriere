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

    	return view('dashboard', [
    		'brukerinfo' => $brukerinfo
		]);
    }
}
