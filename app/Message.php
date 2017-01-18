<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'fra_bruker_id',
    	'til_bruker_id',
    	'tittel',
    	'innhold',
    	'sett_av',
    ];
}
