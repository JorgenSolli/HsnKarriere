<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Company;
use App\Message;
use App\MessagesJunction;
use App\Services\QuerryService;
use Illuminate\Support\Facades\Auth;

class getUsers extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Get Users Controller
    |--------------------------------------------------------------------------
    |
    | This controller is mainly use to find new participants for messages
    | It takes care of the logic beihind figuring out what type of user 
    | can be added, and if you have the accessrights.
    |
    */

	public function __construct() {
        $this->middleware('auth');
    }

	/**
	 * Gets user(s) that can be added to a conversation
	 * The user has to be 
	 *
	 * @param  collection $model the message
	 * @param  class $querryService helpclass for querries
	 * @return array
	 */
    public function listUsers(Message $message, QuerryService $querry_service) {
    	// Check if the auth user belongs to this mesasge (safety)
		MessagesJunction::where('user_id', Auth::id())
    		->where('message_id', $message->id)
    		->firstOrFail();

    	// gets all participants
    	$participants = MessagesJunction::where('message_id', $message->id)
    		->join('users', 'messages_junctions.user_id', '=', 'users.id')
    		->select('user_id', 'bruker_type')
    		->get();

    	$users = [
    		'student'  => false,
    		'bedrift'  => false,
    		'faglarer' => false,
		];

		// Toggles true for participant usertype and gets their ID
		$comapnyUserId = "";
		$studentUserId = "";
		$teacherUserId = "";

    	foreach ($participants as $participant) {
    		if ($participant->bruker_type == 'student') {
    			$users['student'] = true;
    			$studentUserId = $participant->user_id;
    		} elseif ($participant->bruker_type == 'bedrift') {
    			$users['bedrift'] = true;
    			$comapnyUserId = $participant->user_id;
    		} elseif ($participant->bruker_type == 'faglarer') {
    			$users['faglarer'] = true;
    			$teacherUserId = $participant->user_id;
    		}
    	}

    	$list = "";
    	// The message has no student participating. Showing all students
    	if ($users['student'] == false) {
    		$list = $querry_service
    			->finnBedrifter(StudentStudy::where('user_id', $studentUserId)
				->select('studie')
				->get(), false);
    	}

    	// The message has no company participating. Showing all companies
    	elseif ($users['bedrift'] == false) {
    		$list = $querry_service
    			->finnStudenter(Company::where('user_id', $comapnyUserId)
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->select('area_of_Expertise')
                ->get(), false);
    	}

    	// The message has no teacher participating. Showing all teachers
    	elseif ($users['faglarer'] == false) {
    		$list = $querry_service
    			->finnKontakter(Company::where('user_id', $comapnyUserId)
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->select('area_of_Expertise')
                ->get(), false);
    	}

    	$returnHTML = view('includes.selects.listUsers')
    		->with('users', $list)
    		->render();
		return response()->json(array('success' => true, 'data'=>$returnHTML));
    }
}
