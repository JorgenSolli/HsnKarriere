<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentStudy extends Model
{
    protected $fillable = [
    	'user_id',
    	'studie',
    	'campus',
    	'fra',
    	'til',
    ];
}