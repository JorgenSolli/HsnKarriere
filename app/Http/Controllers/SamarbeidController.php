<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Partnership;
use App\User;

class SamarbeidController extends Controller
{
    public function nyttSamarbeid (Request $request) {
    	$samarbeid = New Partnership;

    	// If the teacher is NOT a teacher
    	$foreleser = User::find($request->faglarer);
    	if ($foreleser->bruker_type != "faglarer") {
    		abort(403);
    	}

    	if (Auth::user()->bruker_type == "student") {
    		// If the company is NOT a company
    		$bedrift = User::find($request->bedrift_id);
	    	if ($bedrift->bruker_type != "bedrift") {
	    		abort(403);
	    	}

	    	$samarbeid->bedrift_id 	 = $request->bedrift_id;
	    	$samarbeid->student_id 	 = Auth::id();
    	} 

    	else if (Auth::user()->bruker_type == "bedrift") {
    		// If the student is not a student
    		$student = User::find($request->student_id);
	    	if ($student->bruker_type != "bedrift") {
	    		abort(403);
	    	}

    		$samarbeid->bedrift_id 	 = Auth::id();
	    	$samarbeid->student_id 	 = $request->student_id;
    	}

    	$samarbeid->type_samarbeid   = $request->type;
    	$samarbeid->foreleser_id 	 = $request->faglarer;
    	$samarbeid->save();
    	return back()->with('success', 'Samarbeidet er startet!');
    }
}

