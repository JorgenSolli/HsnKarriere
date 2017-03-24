<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'email',
        'provider',
        'provider_id',
        'password',
        'bruker_type',
        'bruker_aktivert',
        'token',
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
        'bedrift_navn',
        'bedrift_avdeling',
        'foreleser_rom_nr',
        'foreleser_avdeling',
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

    /**
    *
    * Boot the model.
    *
    */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(40);
        });
    }

    public function hasVerified()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }
}
