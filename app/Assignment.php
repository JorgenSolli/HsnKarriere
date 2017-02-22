<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
	protected $fillable = [
		'fil',
		'filnavn',
		'bedrift_id',
		'type',
		'tittel',
		'info'
	];
}
