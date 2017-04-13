<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notification;
use App\Partnership;
use Validator;
use App\User;

class SamarbeidController extends Controller
{   

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Adds a new partnership between a student and a company
     *
     * @param  collection $request
     * @return \Illuminate\Http\Response
     */
    public function nyttSamarbeid (Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'bruker_id'    => 'required',
            'type'          => 'required',
            'faglarer'      => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('danger', 'Alle felt må fylles ut!');
        }

        $samarbeid = New Partnership;
        $bruker_type = Auth::user()->bruker_type;

        // If the teacher is NOT a teacher
        $foreleser = User::find($request->faglarer);
        if ($foreleser->bruker_type != "faglarer") {
    		abort(403);
    	}

    	if ($bruker_type == "student") {
    		// If the company is NOT a company
    		$bedrift = User::find($request->bruker_id);
            
            if ($bedrift->bruker_type != "bedrift") {
                abort(403);
            }
            $checkCurrent = Partnership::where('student_id', Auth::id())
                ->where('bedrift_id', $request->bruker_id)
                ->get();

            if (!$checkCurrent->isEmpty()) {
                return back()->with('danger', 'Du er allerede i et samarbeid med denne bedriften');
            } 

	    	$samarbeid->bedrift_id 	          = $request->bruker_id;
	    	$samarbeid->student_id 	          = Auth::id();
            $samarbeid->godkjent_av_student   = 1;

            $notification = New Notification;
            $notification->user_id = $request->bruker_id;
            $notification->type = "samarbeid";
            $notification->heading = "Nytt samarbeid";
            $notification->message = Auth::user()->fornavn . " " . Auth::user()->etternavn . " vil starte et samarbeid med deg!";
            $notification->save();
    	} 

    	else if ($bruker_type == "bedrift") {
    		// If the student is not a student
    		$student = User::find($request->bruker_id);
	    	if ($student->bruker_type != "student") {
	    		abort(403);
	    	}

            $checkCurrent = Partnership::where('bedrift_id', Auth::id())
                ->where('bedrift_id', $request->bruker_id)
                ->get();

            if (!$checkCurrent->isEmpty()) {
                return back()->with('danger', 'Du er allerede i et samarbeid med denne studenten');
            } 

    		$samarbeid->bedrift_id 	          = Auth::id();
	    	$samarbeid->student_id 	          = $request->bruker_id;
            $samarbeid->godkjent_av_bedrift   = 1;

            $notification = New Notification;
            $notification->user_id = $request->bruker_id;
            $notification->type = "samarbeid";
            $notification->heading = "Nytt samarbeid";
            $notification->message = Auth::user()->bedrift_navn . " vil starte et samarbeid med deg!";
            $notification->save();
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

    /**
     * Confirms a partnership
     *
     * @param  collection $partnership the current partnership
     * @return \Illuminate\Http\Response
     */
    public function godkjennSamarbeid (Partnership $partnership) {     
        $bruker_info = Auth::user();

        if ($bruker_info->bruker_type == "bedrift") {
            if ($partnership->bedrift_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_bedrift = 1;

            $notification = New Notification;
            $notification->type = "samarbeid";
            $notification->heading = "Godkjent samarbeid";
            $notification->user_id = $partnership->student_id;
            $notification->message = Auth::user()->bedrift_navn . " har godtatt samarbeidet!";
            $notification->save();
        }

        elseif ($bruker_info->bruker_type == "student") {
            if ($partnership->student_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_student = 1;

            $notification = New Notification;
            $notification->type = "samarbeid";
            $notification->heading = "Godkjent samarbeid";
            $notification->user_id = $partnership->bedrift_id;
            $notification->message = Auth::user()->fornavn . " " . Auth::user()->etternavn . " har godkjent samarbeidet!";
            $notification->save();
        }

        elseif ($bruker_info->bruker_type == "faglarer") {
            if ($partnership->foreleser_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_foreleser = 1;

            $notification = New Notification;
            $notification->type = "samarbeid";
            $notification->heading = "Godkjent samarbeid";
            $notification->user_id = $partnership->bedrift_id;
            $notification->message = Auth::user()->fornavn . " " . Auth::user()->etternavn . " har godkjent samarbeidet!";
            $notification->save();

            $notification = New Notification;
            $notification->type = "samarbeid";
            $notification->heading = "Godkjent samarbeid";
            $notification->user_id = $partnership->student_id;
            $notification->message = Auth::user()->fornavn . " " . Auth::user()->etternavn . " har godkjent samarbeidet!";
            $notification->save();
        }

        $partnership->save();

        

        return back()->with('success', 'Samarbeidet har nå blitt godkjent.');
    }

    /**
     * Deletes a specific partnership
     *
     * @param collection $partnership a specific partnership
     * @return \Illuminate\Http\Response
     */
    public function slettSamarbeid (Partnership $partnership) {
        $bruker_info = Auth::user();

        if ($bruker_info->bruker_type == "bedrift") {
            if ($partnership->bedrift_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_bedrift = 1;
        } 
        elseif ($bruker_info->bruker_type == "student") {
            if ($partnership->student_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_student = 1;
        } 
        elseif ($bruker_info->bruker_type == "faglarer") {
            if ($partnership->foreleser_id !== $bruker_info->id) {
                return back()->with('danger', 'Noe gikk galt. Prøv igjen.');
            }
            $partnership->godkjent_av_foreleser = 1;
        }

        $partnership->delete();
        return back()->with('success', 'Samarbeidet ble avvist.');
    }

    public function dokumentfeil(Request $request, Partnership $partnership) {
        if ($partnershit->foreleser_id == Auth::id()) {
            if ($request->invalidContract == "kontrakt") {
                $partnership->kontrakt_rejected = 1;
            }
            if ($request->invalidJobdesc == "arbeidsbesk") {
                $partnership->arbeidsbesk_rejected = 1;
            }

            $partnership->rejected_info = $request->description;

            $partnership->save();

            return back()->with('success', 'Student og bedrift har nå fått melding om at det er mangler i dokumentasjonen.');
        }

        abort(403);
    }

    public function godkjennDokumenter (Partnership $partnership)
    {
        if ($partnership->foreleser_id == Auth::id()) {
            $partnership->kontrakt_godkjent_av_foreleser = 1;
            $partnership->save();

            return back()->with('success', 'Dokumentene ble godkjent og samarbeidet kan begynne.');
        }

        abort(403);
    }
}

