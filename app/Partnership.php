<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
    	'bedrift_id',
    	'student_id',
		'foreleser_id',
		'godkjent_av_foreleser',
		'godkjent_av_student',
		'godkjent_av_bedrift',
		'signert_av_student',
		'signert_av_bedrift',
		'kontrakt_godkjent_av_foreleser',
		'kontrakt',
		'arbeidsbesk',
		'startdato',
    ];
}
