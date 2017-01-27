<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Professor;

class QuerryService {

    public function student_studerer($data) {
        $student_studerer = null;
        if ($data != "") {
            $student_studerer = array_chunk(preg_split('/(:|;)/', $data), 4);
        }

        return $student_studerer;
    }

    public function finnBedrifter($studier) {
        $bedrifter = DB::table('companies')
            ->select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed')
            ->join('users', 'companies.user_id', '=', 'users.id')
            ->whereIn('area_of_expertise', $studier)
            ->get();

        return $bedrifter;       
    }

    public function finnStudenter($fagfelt) {
        if (!empty($fagfelt)) {
            $studenter = DB::table('student_studies')
                ->select('fornavn', 'etternavn', 'user_id', 'student_campus', 'forsidebilde', 'profilbilde', 'telefon', 'email')
                ->join('users', 'student_studies.user_id', '=', 'users.id')
                ->whereIn('studie', $fagfelt)
                ->get();

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