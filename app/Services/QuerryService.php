<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\StudentStudy;
use App\Professor;
use App\Company;

class QuerryService {

    public function finnBedrifter($studier, $searchString, $sort) {
        if(!empty($studier)) {
            if ($searchString == false) {
                if ($sort == 'Alfabetisk') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
                        ->orderBy('bedrift_navn', 'ASC')
                        ->get()
                        ->unique('user_id');
                } 
                
                elseif ($sort == 'Relevans') {
                    $currentStudy = StudentStudy::where('user_id', Auth::id())
                        ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                        ->select('study')
                        ->orderBy('student_studies.til', 'DESC')
                        ->first();
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
                        ->orderByRaw("FIELD(area_of_expertise, '$currentStudy->study') DESC")
                        ->get()
                        ->unique('user_id');
                } 
                
                else {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
                        ->get()
                        ->unique('user_id');
                }
            }
            else {
                if ($sort == 'Alfabetisk') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
                        ->orderBy('bedrift_navn', 'ASC')
                        ->get()
                        ->unique('user_id');
                }
                elseif ($sort == 'Relevans') {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
                        ->orderByRaw( "FIELD(area_of_expertise, '$currentStudy->study')" )
                        ->get()
                        ->unique('user_id');
                }
                else {
                    $bedrifter = Company::select('user_id', 'bedrift_navn', 'forsidebilde', 'profilbilde', 'email', 'telefon', 'poststed', 'area_of_expertise')
                        ->where('bedrift_navn', 'like', $searchString . "%")
                        ->orWhere('fornavn', 'like', $searchString . "%")
                        ->orWhere('etternavn', 'like', $searchString . "%")
                        ->orWhere('telefon', 'like', $searchString . "%")
                        ->orWhere('email', 'like', $searchString . "%")
                        ->orWhere('poststed', 'like', $searchString . "%")
                        ->join('users', 'companies.user_id', '=', 'users.id')
                        ->whereIn('area_of_expertise', $studier)
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
    public function finnStudenter($fagfelt, $searchString, $sort) {
        if (!empty($fagfelt)) {

            if ($searchString == false) {
                /* Selects 'bedrift_navn' to determine if to present the name or the company name.
                 * Use case when listing messages reciepments.
                 */
                $studenter = StudentStudy::select('fornavn', 'etternavn', 'user_id', 'student_campus', 'forsidebilde', 'profilbilde', 'telefon', 'email', 'bedrift_navn')
                    ->join('users', 'student_studies.user_id', '=', 'users.id')
                    ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                    ->whereIn('studies.study', $fagfelt)
                    ->get()
                    ->unique('user_id');
            } 
            else {
                $studenter = DB::table('student_studies')
                    ->select('fornavn', 'etternavn', 'user_id', 'student_campus', 'forsidebilde', 'profilbilde', 'telefon', 'email')
                    ->where('fornavn', 'like', $searchString . "%")
                    ->orWhere('etternavn', 'like', $searchString . "%")
                    ->orWhere('telefon', 'like', $searchString . "%")
                    ->orWhere('email', 'like', $searchString . "%")
                    ->orWhere('student_campus', 'like', $searchString . "%")
                    ->join('users', 'student_studies.user_id', '=', 'users.id')
                    ->whereIn('studie', $fagfelt)
                    ->get()
                    ->unique('user_id');
            }

            return $studenter;
        } 
        
        return null;
    }

    public function finnForeleser($fagfelt, $searchString) {
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
}