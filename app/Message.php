<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'fra_bruker_id',
    	'fra_bruker_navn',
    	'til_bruker_id',
    	'til_bruker_navn',
    	'til_bruker_to_id',
    	'til_bruker_to_navn',
    	'tittel',
    	'innhold',
    	'sett_av',
    ];
}
