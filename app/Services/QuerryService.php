<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuerryService {

    public function student_studerer($data) {
        $student_studerer = null;
        if ($data != "") {
            $student_studerer = array_chunk(preg_split('/(:|;)/', $data), 4);
        }

        return $student_studerer;
    }

    public function finnBedrifter($studier) {
        $bedrifter = "";
        $student_studerer = "";

        if ($studier != "") {
            
        }
        if (empty($bedrifter)) {
            $bedrifter = null;
        }

        return $bedrifter;       
    }

    public function finnStudenter($fagType) {
        $studenter = "";

        if ($fagType != "") {
            $bedrift_ser_etter = explode(";", $fagType);

            $sqlFirst = "SELECT * FROM users WHERE ";
            $sqlParams = "`bruker_type` = 'student' AND `student_studerer` LIKE ";
            $sqlCounter = count($bedrift_ser_etter);
            foreach ($bedrift_ser_etter as $fag) {
                if (--$sqlCounter <= 0) {
                    $sqlParams .= " '%" . $fag . ":%'";
                } else {
                    $sqlParams .= "'%" . $fag . ":%' OR `bruker_type` = 'student' AND `student_studerer` LIKE ";
                }
            }
            $sql = $sqlFirst . $sqlParams;

            $studenter = DB::select($sql);
        }

        if (empty($studenter)) {
            $studenter = null;
        }

        return $studenter;       
    }

    public function finnKontakter($fagtype) {
        if (Auth::user()->bruker_type == "student") {

            if ($fagtype != "") {

                return;

            } else {
                return null;
            }


            ;
            $stmt = $conn->prepare($sql);
        }
        else if (Auth::user()->bruker_type == "bedrift") {

        }
    }
}