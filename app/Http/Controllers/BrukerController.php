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
        $bedrifter  = $querry_service->finnBedrifter($brukerinfo->student_studerer)['bedrifter'];
        $kontakter  = "";
        $student_studerer = $querry_service->finnBedrifter($brukerinfo->student_studerer)['student_studerer'];

        return view('bruker.bruker', 
        	[
		    	'bedrifter' => $bedrifter, 
		    	'kontakter' => $kontakter,
		    	'student_studerer' => $student_studerer,
		    	'brukerinfo' => $brukerinfo
        	]);
	}

    public function seBruker(QuerryService $querry_service, $id) {
        $brukerinfo = DB::table('users')->where('id', $id)->first();
        $student_studerer = $student_studerer = array_chunk(preg_split('/(:|;)/', $brukerinfo->student_studerer), 4);

        return view('bruker.seBruker',
            [
                'student_studerer' => $student_studerer,
                'brukerinfo' => $brukerinfo
            ]);
    }
}
