<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\QuerryService;
use Illuminate\Http\Request;

class InnboksController extends Controller
{
    public function seMeldinger() {
    	$brukerinfo = Auth::user();
    	return view('innboks', 
			[
				'brukerinfo' => $brukerinfo
			]);
    }
}
