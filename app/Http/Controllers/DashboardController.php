<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Partnership;
use App\Notification;
use App\User;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles gets the proper data for the user, and returns
    | the view with this data.
    |
    */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Gets the data and returns the view
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard ()
    {	
        // Resets notifications with "samarbeid" when visiting this page
        Notification::where('user_id', Auth::id())
            ->where('type', 'samarbeid')
            ->update(['has_seen' => 1]);

    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
            $partnerships = Partnership::where('student_id', Auth::id())
                ->join('users AS bedrift', 'partnerships.bedrift_id', '=', 'bedrift.id')
                ->join('users AS larer', 'partnerships.foreleser_id', '=', 'larer.id')
                ->select('partnerships.type_samarbeid',
                         'partnerships.godkjent_av_student',
                         'partnerships.godkjent_av_foreleser',
                         'partnerships.godkjent_av_bedrift',
                         'partnerships.signert_av_student',
                         'partnerships.signert_av_bedrift',
                         'partnerships.kontrakt_godkjent_av_foreleser',
                         'partnerships.kontrakt',
                         'partnerships.arbeidsbesk',
                         'partnerships.startdato',
                         'partnerships.created_at',
                         'partnerships.updated_at',
                         'partnerships.id',
                         'bedrift.bedrift_navn AS bedrift_navn',
                         'bedrift.id AS bedrift_id',
                         'larer.fornavn AS larer_fornavn',
                         'larer.etternavn AS larer_etternavn',
                         'larer.id AS larer_id')
                ->orderBy('partnerships.updated_at')
                ->get();
	    	
            return view('dashboard.student.dashboard', [
                'partnerships'  => $partnerships,
	    		'brukerinfo'    => $brukerinfo
			]);
    	}

    	else if ($brukerinfo->bruker_type == "bedrift") {
            $partnerships = Partnership::where('bedrift_id', Auth::id())
                ->join('users AS student', 'partnerships.student_id', '=', 'student.id')
                ->join('users AS larer', 'partnerships.foreleser_id', '=', 'larer.id')
                ->select('partnerships.type_samarbeid',
                         'partnerships.godkjent_av_student',
                         'partnerships.godkjent_av_foreleser',
                         'partnerships.godkjent_av_bedrift',
                         'partnerships.signert_av_student',
                         'partnerships.signert_av_bedrift',
                         'partnerships.kontrakt_godkjent_av_foreleser',
                         'partnerships.kontrakt',
                         'partnerships.arbeidsbesk',
                         'partnerships.startdato',
                         'partnerships.created_at',
                         'partnerships.updated_at',
                         'partnerships.id',
                         'student.fornavn AS student_fornavn',
                         'student.etternavn AS student_etternavn',
                         'student.id AS student_id',
                         'larer.fornavn AS larer_fornavn',
                         'larer.etternavn AS larer_etternavn',
                         'larer.id AS larer_id')
                ->orderBy('partnerships.updated_at')
                ->get();

    		return view('dashboard.bedrift.dashboard', [
                'partnerships'     => $partnerships,
				'brukerinfo'    => $brukerinfo
			]);
    	}

        else if ($brukerinfo->bruker_type == "faglarer") {
            $partnerships = Partnership::where('foreleser_id', Auth::id())
                ->join('users AS student', 'partnerships.student_id', '=', 'student.id')
                ->join('users AS bedrift', 'partnerships.bedrift_id', '=', 'bedrift.id')
                ->select('partnerships.type_samarbeid',
                         'partnerships.godkjent_av_student',
                         'partnerships.godkjent_av_foreleser',
                         'partnerships.godkjent_av_bedrift',
                         'partnerships.signert_av_student',
                         'partnerships.signert_av_bedrift',
                         'partnerships.kontrakt_godkjent_av_foreleser',
                         'partnerships.kontrakt',
                         'partnerships.arbeidsbesk',
                         'partnerships.startdato',
                         'partnerships.created_at',
                         'partnerships.updated_at',
                         'partnerships.id',
                         'student.fornavn AS student_fornavn',
                         'student.etternavn AS student_etternavn',
                         'student.id AS student_id',
                         'bedrift.bedrift_navn AS bedrift_navn',
                         'bedrift.id AS bedrift_id')
                ->orderBy('partnerships.updated_at')
                ->get();

            return view('dashboard.larer.dashboard', [
                'partnerships'  => $partnerships,
                'brukerinfo'    => $brukerinfo
            ]);
        }
    }
}
