<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'bruker_type',
        'bruker_aktivert',
        'fornavn',
        'etternavn',
        'telefon',
        'adresse',
        'postnr',
        'poststed',
        'bio',
        'dob',
        'profilbilde',
        'forsidebilde',
        'student_nr',
        'student_campus',
        'student_cv',
        'student_attester',
        'student_studerer',
        'bedrift_navn',
        'bedrift_avdeling',
        'bedrift_fagfelt',
        'foreleser_rom_nr',
        'nettside',
        'facebook',
        'linkedin',
        'sist_aktiv'
];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
