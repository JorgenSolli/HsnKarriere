<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Professor;
use App\Company;

class QuerryService {

    public function finnBedrifter($studier) {
        $bedrifter = DB::table('companies')
            ->select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
            ->join('users', 'companies.user_id', '=', 'users.id')
            ->whereIn('area_of_expertise', $studier)
            ->get()->unique('user_id');
        return $bedrifter;
    }

    public function finnStudenter($fagfelt) {
        if (!empty($fagfelt)) {
            $studenter = DB::table('student_studies')
                ->select('fornavn', 'etternavn', 'user_id', 'student_campus', 'forsidebilde', 'profilbilde', 'telefon', 'email', 'bedrift_navn')
                ->join('users', 'student_studies.user_id', '=', 'users.id')
                ->whereIn('studie', $fagfelt)
                ->get()->unique('user_id');

            return $studenter;
        } 
        else {
            return null;
        }    
    }

    public function finnKontakter($fagfelt) {
        if (Auth::user()->bruker_type == "student") {

            if ($fagfelt != "") {
                $kontakter = Professor::whereIn('studie', $fagfelt)
                    ->select('fornavn', 'etternavn', 'user_id', 'student_campus')
                    ->join('users', 'professors.user_id', '=', 'users.id')
                    ->get();

                return $kontakter;

            } else {
                return null;
            }
        }
        else if (Auth::user()->bruker_type == "bedrift") {

        }
    }
}