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
        // $meldinger = Message::where('bruker_id', Auth::id())->get();
        
        $messages = collect([]);

        foreach ($junctions as $junction) {
            $data = Message::where('id', $junction->message_id)->first();
            $messages->push([
                'id'            => $data->id,
                'bruker_id'     => $data->bruker_id,
                'bruker_navn'   => $data->bruker_navn,
                'emne'          => $data->emne,
                'melding'       => $data->melding,
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
        $message->bruker_id 	= Auth::id();
        $message->bruker_navn 	= $navn; 		
        $message->emne 			= $request->tittel;
        $message->melding 		= $request->melding;

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

        $sender_info = User::where('id', $message->bruker_id)->first();
        $junctions = MessagesJunction::where('message_id', $message->id)->get();

        $replies = MessagesReply::where('message_id', $message->id)->get();

        $returnHTML = view('includes.innboks.seeMessage')
            ->with('message', $message)
            ->with('sender_info', $sender_info)
            ->with('participants', $junctions)
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
}