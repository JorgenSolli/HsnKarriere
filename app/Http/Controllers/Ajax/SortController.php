<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Services\QuerryService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SortController extends Controller
{
    public function sortList(QuerryService $querry_service) {
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	$bedrifter = $querry_service->finnBedrifter($brukerinfo->student_studerer);

	    	$returnHTML = view('includes.bruker.student.bedrifter.list')
	    		->with('bedrifter', $bedrifter)
	    		->render();
			return response()->json(array('success' => true, 'users-list'=>$returnHTML));
    	}

    	if ($brukerinfo->bruker_type == "bedrift") {
	    	$studenter = $querry_service->finnStudenter($brukerinfo->bedrift_ser_etter);

	    	$returnHTML = view('includes.bruker.bedrift.studenter.list')
	    		->with('studenter', $studenter)
	    		->render();
			return response()->json(array('success' => true, 'users-list'=>$returnHTML));
    	}
    }	

    public function sortCards(QuerryService $querry_service) {
    	$brukerinfo = Auth::user();

    	if ($brukerinfo->bruker_type == "student") {
	    	$bedrifter = $querry_service->finnBedrifter($brukerinfo->student_studerer);

	    	$returnHTML = view('includes.bruker.student.bedrifter.cards')
	    		->with('bedrifter', $bedrifter)
	    		->render();
			return response()->json(array('success' => true, 'users-cards'=>$returnHTML));
		}

		if ($brukerinfo->bruker_type == "bedrift") {
	    	$studenter = $querry_service->finnStudenter($brukerinfo->bedrift_ser_etter);

	    	$returnHTML = view('includes.bruker.bedrift.studenter.cards')
	    		->with('studenter', $studenter)
	    		->render();
			return response()->json(array('success' => true, 'users-cards'=>$returnHTML));
		}
    }
}
