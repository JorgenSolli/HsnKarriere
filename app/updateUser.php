<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class updateUser extends Model
{
    protected $fillable = [
    		'bio', 
    		'fornavn', 
    		'etternavn', 
    		'adresse', 
    		'postNr', 
    		'poststed', 
    		'email', 
    		'dob', 
    		'facebook', 
    		'linkedin', 
    		'studiested', 
    		'studretning', 
    		'campus', 
    		'datoFra', 
    		'datoTil'
    	];
}
