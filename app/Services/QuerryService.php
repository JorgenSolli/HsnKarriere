<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class QuerryService {

  public function student_studerer($data) {
    $student_studerer = null;
    if ($data != "") {
      $student_studerer = array_chunk(preg_split('/(:|;)/', $data), 4);
    }

    return $student_studerer;
  }

  public function finnBedrifter($fagType) {
    $bedrifter = "";
    $student_studerer = "";

    if ($fagType != "") {
      $student_studerer = array_chunk(preg_split('/(:|;)/', $fagType), 4);

      $fagtypeNavnArray = array();
      foreach ($student_studerer as $item) {
        $fagtypeNavnArray[] = $item[0];
      }

      $sqlFirst = "SELECT * FROM users WHERE ";
      $sqlParams = "`bruker_type` = 'bedrift' AND `bedrift_fagfelt` LIKE ";
      $sqlCounter = count($fagtypeNavnArray);
      for ($i = 0; $i <= $sqlCounter; $i++) {
        if (--$sqlCounter <= 0) {
            $sqlParams .= " '%" . $fagtypeNavnArray[$i] . "%'";
        } else {
            $sqlParams .= " '%" . $fagtypeNavnArray[$i] . "%' OR `bruker_type` = 'bedrift' AND `bedrift_fagfelt` LIKE ";
        }
      }
      $sql = $sqlFirst . $sqlParams;
      $bedrifter = DB::select($sql);
    }

    if (empty($bedrifter)) {
      $bedrifter = null;
    }

    return $bedrifter;       
}

  public function finnKontakter($fagtype) {
    return null;
  }
}