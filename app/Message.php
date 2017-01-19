<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'message_id',
    	'bruker_id',
    	'bruker_navn',
    	'emne',
    	'melding',
    	'sett_av',
    ];
}
