<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Message;
use App\MessagesJunction;
use App\MessagesReply;
use App\User;
use App\Services\QuerryService;

class InnboksController extends Controller
{
    public function listMessages() {
    	$brukerinfo = Auth::user();
        $junctions = MessagesJunction::where('user_id', Auth::id())->get();
        
        
        $messages = collect([]);
        $participants = collect([]);

        foreach ($junctions as $junction) {
            $data = Message::where('id', $junction->message_id)->first();
            $participants = DB::table('users')
	        	->join('messages_junctions', 'users.id', '=', 'messages_junctions.user_id')
	        	->select('users.bruker_type', 'users.fornavn', 'users.bedrift_navn')
	        	->where('messages_junctions.message_id', '=', $junction->message_id)
	        	->get();


            $messages->push([
                'id'            => $data->id,
                'participants'	=> $participants,
                'user_id'  	   	=> $data->user_id,
                'subject'       => $data->subject,
                'message'       => $data->message,
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

    public function newMessage (QuerryService $querry_service)
    {   
        $brukerinfo = Auth::user();

        if ($brukerinfo->bruker_type == "student") {
            // Finding the companies the user is allowed to contact
            $kontakter = $querry_service->finnBedrifter($brukerinfo->student_studerer);

            $returnHTML = view('includes.innboks.newMessage')
                ->with('brukerinfo', $brukerinfo)
                ->with('kontakter', $kontakter)
                ->render();
            return response()->json(array('success' => true, 'data' => $returnHTML));
        }


        elseif ($brukerinfo->bruker_type == "bedrift") {
            // Finding the companies the user is allowed to contact
            $kontakter = $querry_service->finnStudenter($brukerinfo->bedrift_ser_etter);

            //dd($kontakter);
            $returnHTML = view('includes.innboks.newMessage')
                ->with('brukerinfo', $brukerinfo)
                ->with('kontakter', $kontakter)
                ->render();
            return response()->json(array('success' => true, 'data' => $returnHTML));
        }
    }

    public function sendNewMessage (Request $request)
    {   
        $message  = New Message;

        if (Auth::user()->bruker_type == "bedrift") {
        	$navn = Auth::user()->bedrift_navn;
        } else {
        	$navn = Auth::user()->fornavn;
        }

        // Gets the message information
        $message->user_id 		= Auth::id();
        $message->user_name 	= $navn; 		
        $message->subject 		= $request->tittel;
        $message->message 		= $request->melding;

        // Saves the message.

        $message->save();
        $messageId = $message->id;

        // Adds the sender to the junction table
        $junction 				= New MessagesJunction;
        $junction->user_id 		= Auth::id();
        $junction->message_id	= $messageId;
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

    public function seeMessage (Message $message)
    {
        $junctions = MessagesJunction::where('message_id', $message->id)->get();
    	
    	// Error trapping and authign
    	$err = false;
    	foreach ($junctions as $junction) {
    		if ($junction->user_id == Auth::id()) {
    			$err = true;
    		}
    	}

    	if (!$err) {
    		abort(403);
    	}

        $sender_info = User::where('id', $message->user_id)->first();

        $replies = DB::table('users')
        	->join('messages_replies', 'users.id', '=', 'messages_replies.user_id')
        	->select( 
        		'users.bruker_type', 
        		'users.profilbilde', 
        		'messages_replies.user_id',
        		'messages_replies.message_id', 
        		'messages_replies.user_name', 
        		'messages_replies.message', 
        		'messages_replies.created_at', 
        		'messages_replies.updated_at')
        	->get();

        $participants = DB::table('users')
                ->join('messages_junctions', 'users.id', '=', 'messages_junctions.user_id')
                ->select('users.id', 'users.profilbilde')
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

    public function replyMessage (Request $request, Message $message)
    {   
        
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

    public function addUser (MessagesJunction $messages_junctions)
    {
        dd($messages_junctions);
    }
}