<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Partnership;
use App\Notification;
use App\User;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function dashboard ()
    {	
        // Resets notifications with "samarbeid" when visiting this page
        Notification::where('user_id', Auth::id())
            ->where('type', 'samarbeid')
            ->update(['has_seen' => 1]);


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
	    	
            return view('dashboard.student.dashboard', [
                'samarbeid'     => $samarbeid,
                'bedrift'       => $bedrift,
                'faglarer'      => $faglarer,
	    		'brukerinfo'    => $brukerinfo
			]);
    	}

    	else if ($brukerinfo->bruker_type == "bedrift") {
            $samarbeid = Partnership::where('bedrift_id', Auth::id())
                ->get();

            $studente = Partnership::where('bedrift_id', Auth::id())
                ->join('users', 'partnerships.student_id', 'users.id')
                ->select('fornavn', 'etternavn', 'email')
                ->get();

            $faglarer = Partnership::where('bedrift_id', Auth::id())
                ->join('users', 'partnerships.foreleser_id', 'users.id')
                ->select('fornavn', 'etternavn', 'email')
                ->get();


    		return view('dashboard.bedrift.dashboard', [
                'samarbeid'     => $samarbeid,
                'student'     => $studente,
                'faglarer'     => $faglarer,
				'brukerinfo'    => $brukerinfo
			]);
    	}

        else if ($brukerinfo->bruker_type == "faglarer") {
            $samarbeid = Partnership::where('foreleser_id', Auth::id())
                ->get();

            $student = Partnership::where('foreleser_id', Auth::id())
                ->join('users', 'partnerships.student_id', 'users.id')
                ->select('fornavn', 'etternavn', 'student_id')
                ->get();

            $bedrift = Partnership::where('foreleser_id', Auth::id())
                ->join('users', 'bedrift_id', 'users.id')
                ->select('bedrift_navn', 'bedrift_id')
                ->get();

            return view('dashboard.larer.dashboard', [
                'samarbeid'     => $samarbeid,
                'student'       => $student,
                'bedrift'       => $bedrift,
                'brukerinfo'    => $brukerinfo
            ]);
        }

    }
}
