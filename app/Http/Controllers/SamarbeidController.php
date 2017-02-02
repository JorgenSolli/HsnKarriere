<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notification;
use App\Partnership;
use App\User;

class SamarbeidController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function nyttSamarbeid (Request $request) {
    	$samarbeid = New Partnership;
        $bruker_type = Auth::user()->bruker_type;

    	// If the teacher is NOT a teacher
    	$foreleser = User::find($request->faglarer);
    	if ($foreleser->bruker_type != "faglarer") {
    		abort(403);
    	}

    	if ($bruker_type == "student") {
    		// If the company is NOT a company
    		$bedrift = User::find($request->bedrift_id);
            
            if ($bedrift->bruker_type != "bedrift") {
                abort(403);
            }
            $checkCurrent = Partnership::where('student_id', Auth::id())
                ->where('bedrift_id', $request->bedrift_id)
                ->get();

            if (!$checkCurrent->isEmpty()) {
                return back()->with('danger', 'Du er allerede i et samarbeid med denne bedriften');
            } 

	    	$samarbeid->bedrift_id 	          = $request->bedrift_id;
	    	$samarbeid->student_id 	          = Auth::id();
            $samarbeid->godkjent_av_student   = 1;

            $notification = New Notification;
            $notification->user_id = $request->bedrift_id;
            $notification->type = "samarbeid";
            $notification->heading = "Nytt samarbeid";
            $notification->message = Auth::user()->fornavn . " " . Auth::user()->etternavn . " vil starte et samarbeid med deg!";
            $notification->save();
    	} 

    	else if ($bruker_type == "bedrift") {
    		// If the student is not a student
    		$student = User::find($request->student_id);
	    	if ($student->bruker_type != "bedrift") {
	    		abort(403);
	    	}

            $checkCurrent = Partnership::where('bedrift_id', Auth::id())
                ->where('bedrift_id', $request->student_id)
                ->get();

            if (!$checkCurrent->isEmpty()) {
                return back()->with('danger', 'Du er allerede i et samarbeid med denne studenten');
            } 

    		$samarbeid->bedrift_id 	          = Auth::id();
	    	$samarbeid->student_id 	          = $request->student_id;
            $samarbeid->godkjent_av_bedrift   = 1;
    	}

        // Sends a notification to the professor
        $notification = New Notification;
        $notification->user_id = $request->faglarer;
        $notification->type = "samarbeid";
        $notification->heading = "Venter på din bekreftelse";
        $notification->message = "Et nytt samarbeid er blitt startet!";
        $notification->save();

    	$samarbeid->type_samarbeid   = $request->type;
    	$samarbeid->foreleser_id 	 = $request->faglarer;
    	$samarbeid->save();

    	return back()->with('success', 'Samarbeidet er startet!');
    }

    public function godkjennSamarbeid (Partnership $partnership) {
        // todo: seciritycheck
        $bruker_type = Auth::user()->bruker_type;

        if ($bruker_type == "bedrift") {
            $partnership->godkjent_av_bedrift = 1;
        } elseif ($bruker_type == "student") {
            $partnership->godkjent_av_student = 1;
        } elseif ($bruker_type == "faglarer") {
            $partnership->godkjent_av_foreleser = 1;
        }

        $partnership->save();

        return back()->with('success', 'Samarbeidet har nå blitt godkjent.');
    }

    public function slettSamarbeid (Partnership $partnership) {
        // todo: seciritycheck
        $partnership->delete();
        return back()->with('success', 'Samarbeidet ble avvist.');
    }
}

