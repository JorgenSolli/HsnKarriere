<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Services\QuerryService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\StudentStudy;

class SortController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Sort Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the logic for showing students/companies and 
    | teachers. It has the functions to sort them, show them in cards or list
    | view, and also has a searchoption.
    |
    */

	public function __construct() {
        $this->middleware('auth');
    }

    /**
    * Find users connected to you in a listed style
    *
    * @param  class $querry_service
    * @param  collection $request
    * @param  string $display
    * @return response
    */
    public function showUsers(QuerryService $querry_service, Request $request) {
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	$student_studerer = StudentStudy::where('user_id', Auth::id())
	    		->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                ->select('study')
                ->get();

            if ($request->searching == true) {
            	$bedrifter  = $querry_service->finnBedrifter($student_studerer, $request->searchString, $request->sort);
			} 
			else {
	    		$bedrifter  = $querry_service->finnBedrifter($student_studerer, false, $request->sort);
			}


			if ($request->json) {
				return response()->json(array('data'=>$bedrifter));
			}

	    	$returnHTML = view('partials.user.student.bedrifter.' . $request->display)
	    		->with('bedrifter', $bedrifter)
	    		->render();
			return response()->json(array('success' => true, 'data'=>$returnHTML));
		}

		elseif ($brukerinfo->bruker_type == "bedrift") {
			$area_of_expertise = Company::select('area_of_expertise')
				->where('user_id', Auth::id())
				->get();
				
			if ($request->searching == true) {
				$studenter = $querry_service->finnStudenter($area_of_expertise, $request->searchString);
			} 
			else {
	    		$studenter = $querry_service->finnStudenter($area_of_expertise, false);
			}
			
	    	$returnHTML = view('partials.user.bedrift.studenter.' . $request->display)
	    		->with('studenter', $studenter)
	    		->render();
			return response()->json(array('success' => true, 'data'=>$returnHTML));
		}

    	else {
			return abort(403);
		}
    }
}
