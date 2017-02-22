<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagesReply extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    	'message_id',
    	'user_id',
    	'user_name',
    	'message',
    ];
}
