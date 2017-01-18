<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_Reply extends Model
{
    protected fillable = [
    	'melding_id',
    	'forfatter',
    	'innhold',
    	'sett_av',
    ];
}
