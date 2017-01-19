<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Message;
use App\MessagesJunction;
use App\Messages_Reply;
use App\User;
use App\Services\QuerryService;

class InnboksController extends Controller
{
    public function seMeldinger() {
    	$brukerinfo = Auth::user();
    	$meldinger = Message::where('bruker_id', Auth::id())->get();


    	return view('innboks', 
			[
				'brukerinfo' 	=> $brukerinfo,
				'meldinger'		=> $meldinger
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
            return false;
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
    	$message_id  = $message->message_id;
        $sender_info = User::where('id', $message->bruker_id)->first();


        $returnHTML = view('includes.innboks.seeMessage')
            ->with('message', $message)
            ->with('sender_info', $sender_info)
            ->with('reciepment_one_info', $reciepment_one_info)
            ->with('reciepment_two_info', $reciepment_two_info)
            ->render();
        return response()->json(array('success' => true, 'data' => $returnHTML));
        dd($message);
    }
}
