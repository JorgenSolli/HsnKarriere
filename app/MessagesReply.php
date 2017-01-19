<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagesReply extends Model
{
    protected $fillable = [
    	'message_id',
    	'user_id',
    	'user_name',
    	'message',
    ];
}
