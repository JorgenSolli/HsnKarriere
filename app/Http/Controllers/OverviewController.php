<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Partnership;
use App\User;

class OverviewController extends Controller
{
    public function dashboard ()
    {	
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
            $samarbeid = Partnership::where('student_id', Auth::id())
                ->get();

            $bedrift = Partnership::where('student_id', Auth::id())
                ->join('users', 'partnerships.bedrift_id', '=', 'users.id')
                ->select('bedrift_navn', 'bedrift_id', 'email')
                ->get();

            $faglarer = Partnership::where('student_id', Auth::id())
                ->join('users', 'partnerships.foreleser_id', '=', 'users.id')
                ->select('fornavn', 'etternavn', 'email')
                ->get();
	    	
            return view('bruker.student.dashboard', [
                'samarbeid'     => $samarbeid,
                'bedrift'       => $bedrift,
                'faglarer'      => $faglarer,
	    		'brukerinfo'    => $brukerinfo
			]);
    	}

    	else if ($brukerinfo->bruker_type == "bedrift") {
    		return view('bruker.bedrift.dashboard', [
				'brukerinfo'     => $brukerinfo
			]);
    	}

    }
}
