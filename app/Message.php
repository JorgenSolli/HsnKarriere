<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    	'user_id',
    	'user_name',
    	'subject',
    	'message',
    ];
}
