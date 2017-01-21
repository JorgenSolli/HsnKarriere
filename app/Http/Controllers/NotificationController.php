<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MessagesJunction;

class NotificationController extends Controller
{
    public function notification ()
    {
    	$returnHTML = view('popovers.notifications')
            ->with('data', 'this is the data')
            ->render();
        return response()->json(array('success' => true, 'data' => $returnHTML));
    }

    public function check ()
    {
    	
    }
}
