<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class QuerryService {

    public function finnBedrifter($fagType) {
        $bedrifter = "";
        $fagtyper = "";

        if ($fagType != "") {
            $fagtyper = array_chunk(preg_split('/(:|;)/', $fagType), 4);

            $fagtypeNavnArray = array();
            foreach ($fagtyper as $item) {
                $fagtypeNavnArray[] = $item[0];
            }

            $sqlFirst = "SELECT * FROM users WHERE ";
            $sqlParams = "`brukerType` = 'bedrift' AND `fagType` LIKE ";
            $sqlCounter = count($fagtypeNavnArray);
            for ($i = 0; $i <= $sqlCounter; $i++) {
                if (--$sqlCounter <= 0) {
                    $sqlParams .= " '%" . $fagtypeNavnArray[$i] . "%'";
                } else {
                    $sqlParams .= " '%" . $fagtypeNavnArray[$i] . "%' OR `brukerType` = 'bedrift' AND `fagType` LIKE ";
                }
            }
            $sql = $sqlFirst . $sqlParams;
            $bedrifter = DB::select($sql);
        }

        return [
            'bedrifter' => $bedrifter,
            'fagtyper' => $fagtyper
        ];       
    }

    public function finnKontakter($fagtype) {
        return null;
    }
}