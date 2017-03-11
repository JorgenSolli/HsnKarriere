<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Message;
use App\Company;
use App\Professor;
use App\StudentStudy;
use App\MessagesReply;
use App\MessagesJunction;
use App\Services\QuerryService;

class InnboksController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Innboks Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles logic related the the inbox.
    | All CRUD operations are handeled here.
    | 
    */

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Lists all messages the user has access to.
     * 
     * @return \Illuminate\Http\Response
     */
    public function listMessages() 
    {
    	$brukerinfo = Auth::user();
        $junctions = MessagesJunction::where('user_id', Auth::id())->get();
        
        $messages = collect([]);
        $participants = collect([]);

        foreach ($junctions as $junction) {
            $data = Message::where('id', $junction->message_id)->first();
            $participants = DB::table('users')
	        	->join('messages_junctions', 'users.id', '=', 'messages_junctions.user_id')
	        	->select('users.bruker_type', 'users.fornavn', 'users.bedrift_navn', 'messages_junctions.message_read')
	        	->where('messages_junctions.message_id', '=', $junction->message_id)
	        	->get();

            $message_read = DB::table('users')
                ->join('messages_junctions', 'users.id', '=', 'messages_junctions.user_id')
                ->select('messages_junctions.message_read')
                ->where('messages_junctions.message_id', '=', $junction->message_id)
                ->where('messages_junctions.user_id', '=', Auth::id())
                ->first();

            $messages->push([
                'id'            => $data->id,
                'participants'	=> $participants,
                'user_id'  	   	=> $data->user_id,
                'subject'       => $data->subject,
                'message'       => $data->message,
                'message_read'  => $message_read->message_read,
                'created_at'    => $data->created_at,
                'updated_at'    => $data->updated_at,
            ]);
        }

    	return view('innboks', 
			[
				'brukerinfo' 	=> $brukerinfo,
				'messages'		=> $messages
			]);
    }

    /**
     * Created a new message in the database
     * 
     * @param  class $querryservice
     * @return \Illuminate\Http\Response
     */
    public function newMessage (QuerryService $querry_service)
    {   
        $brukerinfo = Auth::user();

        if ($brukerinfo->bruker_type == "student") {
            // Finding the companies the user is allowed to contact
            $kontakter = $querry_service->finnBedrifter(StudentStudy::where('user_id', Auth::id())->select('studie')->get(), false);

            $returnHTML = view('includes.innboks.newMessage')
                ->with('brukerinfo', $brukerinfo)
                ->with('kontakter', $kontakter)
                ->render();
            return response()->json(array('success' => true, 'data' => $returnHTML));
        }

        elseif ($brukerinfo->bruker_type == "bedrift") {
            // Finding the companies the user is allowed to contact
            $kontakter = $querry_service->finnStudenter(Company::where('user_id', Auth::id())
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->select('area_of_expertise')
                ->get(), false);

            $returnHTML = view('includes.innboks.newMessage')
                ->with('brukerinfo', $brukerinfo)
                ->with('kontakter', $kontakter)
                ->render();
            return response()->json(array('success' => true, 'data' => $returnHTML));
        }

        elseif ($brukerinfo->bruker_type == "faglarer") {
            // Finding the companies the user is allowed to contact
            $kontakterStudenter = $querry_service->finnStudenter(Professor::where('user_id', Auth::id())
                ->join('users', 'professors.user_id', '=', 'users.id')
                ->select('studie')
                ->get(), false);

            $kontakterBedrifter = $querry_service->finnBedrifter(Professor::where('user_id', Auth::id())
                ->join('users', 'professors.user_id', '=', 'users.id')
                ->select('studie')
                ->get(), false);

            $returnHTML = view('includes.innboks.faglarer.newMessage')
                ->with('brukerinfo', $brukerinfo)
                ->with('kontakterStudenter', $kontakterStudenter)
                ->with('kontakterBedrifter', $kontakterBedrifter)
                ->render();
            return response()->json(array('success' => true, 'data' => $returnHTML));
        }
    }

    /**
     * Sends a message to a specific user(s)
     * 
     * @param  collection $request
     * @return \Illuminate\Http\Response
     */
    public function sendNewMessage (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mottakere'     => 'required',
            'tittel'         => 'required',
            'melding'       => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('danger', 'Alle felt må fylles ut!');
        }

        $message = New Message;

        if (Auth::user()->bruker_type == "bedrift") {
        	$user_name = Auth::user()->bedrift_navn;
        } else {
        	$user_name = Auth::user()->fornavn;
        }

        // Gets the message information
        $message->user_id 		= Auth::id();
        $message->user_name 	= $user_name; 		
        $message->subject 		= $request->tittel;
        $message->message 		= $request->melding;

        // Saves the message.
        $message->save();
        $messageId = $message->id;

        // Adds the sender to the junction table
        $junction 				= New MessagesJunction;
        $junction->user_id 		= Auth::id();
        $junction->message_id	= $messageId;
        $junction->message_read = 1;
        $junction->save();

        // Adds all reciepments to the junction table
        foreach ($request->mottakere as $mottaker) {
        	$junction = New MessagesJunction;
        	$junction->user_id = $mottaker;
        	$junction->message_id = $messageId;
        	$junction->save();
        }

        return back()->with('success', 'Meldingen ble sendt!');
    }

    /**
     * View a specific Message
     *
     * @param  collection $message
     * @return \Illuminate\Http\Response
     */
    public function seeMessage (Message $message)
    {
        $junctions = MessagesJunction::where('message_id', $message->id)->get();
    	
    	// Error trapping and authign
    	$err = false;
    	foreach ($junctions as $junction) {
    		if ($junction->user_id == Auth::id()) {
    			$err = true;
                $setRead = MessagesJunction::where('user_id', Auth::id())
                    ->where('message_id', $message->id)
                    ->update(['message_read' => 1]);
    		}
    	}

    	if (!$err) {
    		abort(403);
    	}

        $sender_info = User::where('id', $message->user_id)->first();

        $replies = DB::table('users')
        	->join('messages_replies', 'users.id', '=', 'messages_replies.user_id')
            ->where('message_id', '=', $message->id)
        	->select( 
        		'users.bruker_type', 
        		'users.profilbilde', 
        		'messages_replies.user_id',
        		'messages_replies.message_id',
        		'messages_replies.message', 
        		'messages_replies.created_at', 
        		'messages_replies.updated_at')
        	->get();

        $participants = DB::table('users')
            ->join('messages_junctions', 'users.id', '=', 'messages_junctions.user_id')
            ->select('users.id', 'users.profilbilde', 'message_read')
            ->where('messages_junctions.message_id', '=', $junction->message_id)
            ->get();

        $returnHTML = view('includes.innboks.seeMessage')
            ->with('message', $message)
            ->with('sender_info', $sender_info)
            ->with('participants', $participants)
            ->with('replies', $replies)
            ->render();
        return response()->json(array('success' => true, 'data' => $returnHTML));
    }

    /**
     * Adds a reply to the DB
     *
     * @param  collection $request
     * @param  collection $request
     * @return \Illuminate\Http\Response
     */
    public function replyMessage (Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'reply' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('danger', 'Du kan ikke sende en tom melding!');
        }

        $reply = New MessagesReply;
        $reply->message_id = $message->id;
        $reply->user_id = Auth::id();
        $reply->message = $request->reply;

        if (Auth::User()->bruker_type == "bedrift") {
            $reply->user_name = Auth::User()->bedrift_navn;
        } else {
            $reply->user_name = Auth::User()->fornavn;
        }

        $reply->save();

        return back()->with('success', 'Svar sendt');
    }

    /**
     * Adds a user to a message in the DB
     *
     * @param  collection $message
     * @param  collection $request
     * @return \Illuminate\Http\Response
     */
    public function addUser (Message $message, Request $request)
    {
        dd($message);
        //todo: finish this method
    }
}