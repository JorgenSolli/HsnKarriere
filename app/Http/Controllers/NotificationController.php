<?php

namespace App\Http\Controllers;

use App\Notification;
use App\MessagesJunction;
use App\Services\DateFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }
    
    public function notification (DateFormater $date_formater)
    {
		$notifications = Notification::where('user_id', Auth::id())
			->orderBy('has_seen', 'asc')
			->limit(2)
			->get();
    	
    	$latestMessages = DB::table('messages_junctions')
    		->where('user_id', '=', Auth::id())
    		->orderBy('message_read', 'asc')
    		->limit(5)
			->get();

		$data = collect([]);

		foreach ($latestMessages as $latestMessage) {
			$message = DB::table('messages_replies')
				->where('message_id', '=', $latestMessage->message_id)
				->orderBy('updated_at', 'desc')
				->get();

			// No replies, Returns the first message
			if ($message->isEmpty()) {
				$query = DB::table('messages')
					->where('id', '=', $latestMessage->message_id)
					->first();

				$data->push([
					'message_id' 	=> $query->id,
					'user_name'		=> $query->user_name,
					'subject'		=> $query->subject,
					'message'		=> $query->message,
					'updated_at'	=> $date_formater->timeElapsed($query->updated_at),
					'message_read' 	=> $latestMessage->message_read
				]);
			} 
			// Replies belong to an unread message.
			else {
				$query = DB::table('messages_replies')
					->where('message_id', '=', $latestMessage->message_id)
					->orderBy('updated_at', 'desc')
					->first();

				$data->push([
					'message_id' 	=> $query->message_id,
					'user_name'		=> $query->user_name,
					'subject'		=> null,
					'message'		=> $query->message,
					'updated_at'	=> $date_formater->timeElapsed($query->updated_at),
					'message_read' 	=> $latestMessage->message_read
				]);
			}
		}

    	$returnHTML = view('popovers.notifications')
    		->with('notifications', $notifications)
            ->with('messages', $data)
            ->render();
        return response()->json(array('success' => true, 'data' => $returnHTML));
    }

    public function check ()
    {
    	$unreadMessages = DB::table('messages_junctions')
    		->where([
    			['user_id', '=', Auth::id()],
    			['message_read', '=', '0']
			])
			->count();

		$notifications = Notification::where('user_id', Auth::id())
			->where('has_seen', null)
			->count();

		$total = $unreadMessages + $notifications;

		$returnHTML = view('popovers.check')
            ->with('unreadCount', $total)
            ->render();
        return response()->json(array('success' => true, 'data' => $returnHTML));
    }
}
