<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuerryService;

class BrukerController extends Controller
{
    public function bruker(QuerryService $querry_service) {
        $brukerinfo = Auth::user();
        $bedrifter  = $querry_service->finnBedrifter($brukerinfo->fagType)['bedrifter'];
        $kontakter  = "";
        $fagtyper   = $querry_service->finnBedrifter($brukerinfo->fagType)['fagtyper'];

        return view('bruker.bruker', 
        	[
		    	'bedrifter' => $bedrifter, 
		    	'kontakter' => $kontakter,
		    	'fagtyper' => $fagtyper,
		    	'brukerinfo' => $brukerinfo
        	]);
	}

    public function seBruker(QuerryService $querry_service, $id) {
        $brukerinfo = DB::table('users')->where('id', $id)->first();
        $fagtyper = $fagtyper = array_chunk(preg_split('/(:|;)/', $brukerinfo->fagType), 4);

        return view('bruker.seBruker',
            [
                'fagtyper' => $fagtyper,
                'brukerinfo' => $brukerinfo
            ]);
    }
}
