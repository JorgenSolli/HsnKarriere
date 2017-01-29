<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
    	'user_id',
    	'has_seen',
    	'type',
    	'heading',
    	'message',
    ];
}
