<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'bedrift_id',
        'sted',
        'varighet_int',
        'varighet_prefix',
        'type',
        'frist',
        'stilling_tittel',
        'bransje',
        'info',
    ];
}
