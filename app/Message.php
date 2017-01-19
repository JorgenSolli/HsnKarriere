<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'bruker_id',
    	'bruker_navn',
    	'emne',
    	'melding',
    ];
}
