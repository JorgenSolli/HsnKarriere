<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\StudentStudy;
use App\Professor;
use App\Company;
use App\User;

class QuerryService {

    public function finnBedrifter($brukerId, $searchString, $sort) {
        if ($brukerId) {
            $brukerinfo = User::where('id', $brukerId)->firstOrFail();

            if ($brukerinfo->bruker_type == "student") {
                $fag = StudentStudy::where('user_id', $brukerId)
                    ->select('studie_id')
                    ->get();
            } elseif ($brukerinfo->bruker_type == "faglarer") {
                $fag = Professor::where('user_id', $brukerId)
                    ->select('studie_id')
                    ->get();
            }

            if ($searchString == false) {
                if ($sort == 'Alfabetisk') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->orderBy('bedrift_navn', 'ASC')
                        ->get()
                        ->unique('user_id');
                } 
                
                elseif ($sort == 'Relevans') {
                    $currentStudy = StudentStudy::where('user_id', $brukerId)
                        ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                        ->select('study')
                        ->orderBy('student_studies.til', 'DESC')
                        ->first();

                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->orderByRaw("FIELD(studie_id, '$currentStudy->study') DESC")
                        ->get()
                        ->unique('user_id');
                } 
                
                else {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->get()
                        ->unique('user_id');
                }
            }
            else {
                if ($sort == 'Alfabetisk') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $studier)
                        ->orderBy('bedrift_navn', 'ASC')
                        ->get()
                        ->unique('user_id');
                }
                elseif ($sort == 'Relevans') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $studier)
                        ->orderByRaw( "FIELD(studie_id, '$currentStudy->study')" )
                        ->get()
                        ->unique('user_id');
                }
                else {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'studie_id')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $studier)
                        ->get()
                        ->unique('user_id');
                }
            }
            return $bedrifter;
        }
        
        return null;
    }

    /**
     * Returns all users connected to a company. A parameter for specific search can allso be used.
     *
     * @param $fagfelt Collection of users area of expertise
     * @param $searchstring Optional searchstring for a more specific output
     * 
     * @return A collection of results
     */
    public function finnStudenter($brukerId, $searchString, $sort) {
        if ($brukerId) {
            $brukerinfo = User::where('id', $brukerId)->firstOrFail();

            if ($brukerinfo->bruker_type == "bedrift") {
                $fag = Company::where('user_id', $brukerId)
                    ->select('studie_id')
                    ->get();
            } 
            elseif ($brukerinfo->bruker_type == "faglarer") {
                $fag = Professor::where('user_id', $brukerId)
                    ->select('studie_id')
                    ->get();
            }

            if ($searchString == false) {
                if ($sort == 'Alfabetisk') {
                    $studenter = StudentStudy::select(
                            'email', 
                            'user_id', 
                            'telefon', 
                            'fornavn', 
                            'poststed', 
                            'etternavn', 
                            'studie_id',
                            'forsidebilde', 
                            'profilbilde')
                        ->where('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->orWhere('student_campus', 'like', $searchString . "%")
                        ->join('users', 'student_studies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->orderBy('bedrift_navn', 'ASC')
                        ->get()
                        ->unique('user_id');
                } 
                else {
                    $studenter = StudentStudy::select(
                            'email', 
                            'user_id', 
                            'telefon', 
                            'fornavn', 
                            'poststed', 
                            'etternavn', 
                            'studie_id',
                            'forsidebilde', 
                            'profilbilde')
                        ->join('users', 'student_studies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->get()
                        ->unique('user_id');
                }
            }
            else {
                if ($sort == 'Alfabetisk') {
                    $studenter = StudentStudy::select(
                            'email', 
                            'user_id', 
                            'telefon', 
                            'fornavn', 
                            'poststed', 
                            'etternavn', 
                            'studie_id',
                            'forsidebilde', 
                            'profilbilde')
                        ->join('users', 'student_studies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->orderBy('fornavn', 'ASC')
                        ->get()
                        ->unique('user_id');
                }
                elseif ($sort == 'Relevans') {
                    $studenter = StudentStudy::select(
                            'email', 
                            'user_id', 
                            'telefon', 
                            'fornavn', 
                            'poststed', 
                            'etternavn', 
                            'studie_id',
                            'forsidebilde', 
                            'profilbilde')
                        ->where('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->orWhere('student_campus', 'like', $searchString . "%")
                        ->join('users', 'student_studies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->orderByRaw( "FIELD(studie_id, '$currentStudy->study')" )
                        ->get()
                        ->unique('user_id');
                }
                else {
                    $studenter = StudentStudy::select(
                            'email', 
                            'user_id', 
                            'telefon', 
                            'fornavn', 
                            'poststed', 
                            'etternavn', 
                            'studie_id',
                            'forsidebilde', 
                            'profilbilde')
                        ->where('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->orWhere('student_campus', 'like', $searchString . "%")
                        ->join('users', 'student_studies.user_id', '=', 'users.id')
                        ->whereIn('studie_id', $fag)
                        ->get()
                        ->unique('user_id');
                }
            }

            return $studenter;
        } 
        
        return null;
    }

    public function finnForeleser($brukerId, $searchString) {
        if ($brukerId) {
            $brukerinfo = User::where('id', $brukerId)->first();

            if ($brukerinfo->bruker_type == "student") 
            {
                $fag = StudentStudy::where('user_id', $brukerId)
                    ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                    ->get();

                $studentCampus = User::where('id', $brukerId)
                    ->select('student_campus')
                    ->first();

                $forelesere = Professor::whereIn('studie_id', $fag)
                    ->join('users', 'professors.user_id', '=', 'users.id')
                    ->get();
            }

            elseif ($brukerinfo->bruker_type == "bedrift") 
            {
                $fag = Company::where('user_id', $brukerId)
                    ->select('studie_id')
                    ->get();
                $forelesere = Professor::whereIn('studie_id', $fag)
                    ->join('users', 'professors.user_id', '=', 'users.id')
                    ->get();
            }
            
            return $forelesere;

        } else {
            return null;
        }
    }
}