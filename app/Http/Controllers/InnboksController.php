<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Message;
use App\Message_Reply;

class InnboksController extends Controller
{
    public function seMeldinger() {
    	$brukerinfo = Auth::user();
    	$meldinger = Message::where('fra_bruker_id', Auth::id())
    		->orWhere('til_bruker_id', Auth::id())->get();


    	return view('innboks', 
			[
				'brukerinfo' 	=> $brukerinfo,
				'meldinger'		=> $meldinger
			]);
    }
}
