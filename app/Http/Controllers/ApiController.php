<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Campus;
use App\Study;
use App\User;

class ApiController extends Controller
{
    public function getCampuses ()
    {
    	return response()->json(array('campuses' => Campus::get()));
    }

    public function getStudies (Request $request)
    {
		if ($request->json) {
			if ($request->campus) {
				$data = Study::where('campus', $request->campus)
					->where('study', 'like',  '%' . $request->q . '%')
					->get();
	    		return $data;
			}

	    	return response()->json(array('studies' => Study::get()));
		} 

		else {
			if ($request->campus) {
				$data = Study::where('campus', $request->campus)
					->where('study', 'like',  '%' . $request->q . '%')
					->get();
			} else {
				$data = Study::get();
			}

			$returnHTML = view('includes.selects.studier')
	    		->with('studies', $data)
	    		->with('brukerinfo', Auth::user())
	    		->render();

			return response()->json(array('success' => true, 'data'=>$returnHTML));
		}

    }

    /**
    * Checks if an email already exists in the DB.
    *
    * @return boolean
    */
    public function checkEmail (Request $request) {
    	$email = $request->email;
    	$search = User::where('email', $email)
    		->where('id', '!=', Auth::id())
    		->first();

    	if ($search) {
    		return response()->json(true);
    	}

		return response()->json(false);
    }
}