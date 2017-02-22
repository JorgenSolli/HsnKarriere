<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessagesJunction extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    	'message_id',
    	'user_id',
    	'message_read',
    ];
}
