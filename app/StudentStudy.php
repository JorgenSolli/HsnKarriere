<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentStudy extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    	'user_id',
    	'studie_id',
    	'campus',
    	'fra',
    	'til',
    ];
}
