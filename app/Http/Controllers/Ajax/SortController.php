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
	public function __construct() {
        $this->middleware('auth');
    }
    
    public function sortList(QuerryService $querry_service) {
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	$student_studerer = StudentStudy::where('user_id', Auth::id())
                ->select('studie')
                ->get();
            $bedrifter  = $querry_service->finnBedrifter($student_studerer);

	    	$returnHTML = view('includes.bruker.student.bedrifter.list')
	    		->with('bedrifter', $bedrifter)
	    		->render();
			return response()->json(array('success' => true, 'users-list'=>$returnHTML));
    	}

    	if ($brukerinfo->bruker_type == "bedrift") {
    		$studenter = $querry_service->finnStudenter(Company::select('area_of_expertise')->where('user_id', Auth::id())->get());

	    	$returnHTML = view('includes.bruker.bedrift.studenter.list')
	    		->with('studenter', $studenter)
	    		->render();
			return response()->json(array('success' => true, 'users-list'=>$returnHTML));
    	}
    }	

    public function sortCards(QuerryService $querry_service) {
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	$student_studerer = StudentStudy::where('user_id', Auth::id())
                ->select('studie')
                ->get();
            $bedrifter  = $querry_service->finnBedrifter($student_studerer);

	    	$returnHTML = view('includes.bruker.student.bedrifter.cards')
	    		->with('bedrifter', $bedrifter)
	    		->render();
			return response()->json(array('success' => true, 'users-cards'=>$returnHTML));
		}

		if ($brukerinfo->bruker_type == "bedrift") {
	    	$studenter = $querry_service->finnStudenter(Company::select('area_of_expertise')->where('user_id', Auth::id())->get());

	    	$returnHTML = view('includes.bruker.bedrift.studenter.cards')
	    		->with('studenter', $studenter)
	    		->render();
			return response()->json(array('success' => true, 'users-cards'=>$returnHTML));
		}
    }
}
