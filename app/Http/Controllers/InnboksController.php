<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Message;
use App\Message_Reply;
use App\User;
use App\Services\QuerryService;

class InnboksController extends Controller
{
    public function seMeldinger() {
    	$brukerinfo = Auth::user();
    	$meldinger = Message::where('fra_bruker_id', Auth::id())
    		->orWhere('til_bruker_id', Auth::id())->get();


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

    public function sendMessage (Request $request)
    {   
        $message = New Message;

        $message->fra_bruker_id     = Auth::id();
        $message->tittel            = $request->tittel;
        $message->innhold           = $request->melding;
        $message->til_bruker_id     = $request->mottakere[0];
        $mottaker_one               = User::find($request->mottakere[0]);

        if (Auth::user()->bruker_type == "bedrift") {
            $message->fra_bruker_navn = Auth::user()->bedrift_navn;
        } else {
            $message->fra_bruker_navn = Auth::user()->fornavn;
        }

        if ($mottaker_one->bruker_type == "bedrift") {
            $message->til_bruker_navn = $mottaker_one->bedrift_navn;
        } else {
            $message->til_bruker_navn = $mottaker_one->fornavn;
        }

        // Adds the second reciepment if the user is selected.
        if (!empty($request->mottakere[1])) {
            $mottaker_two = User::find($request->mottakere[1]);

            if ($mottaker_two->bruker_type == "bedrift") {
                $message->til_bruker_navn = $mottaker_two->bedrift_navn;
            } else {
                $message->til_bruker_navn = $mottaker_two->fornavn;
            }
            $message->til_bruker_to_id  = $request->mottakere[1];
        }

        // Saves the message.
        $message->save();

        return back()->with('success', 'Meldingen ble sendt!');
    }

    public function seeMessage (Message $message)
    {
        $sender_info            = User::where('id', $message->fra_bruker_id)->first();
        $reciepment_one_info    = User::where('id', $message->til_bruker_id)->first();

        if (!empty($message->til_bruker_to_id)) {
            $reciepment_two_info    = User::where('id', $message->til_bruker_to_id)->first();
        } else {
            $reciepment_two_info = null;
        }

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
