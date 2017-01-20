<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'user_id',
    	'user_name',
    	'subject',
    	'message',
    ];
}
