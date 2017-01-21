<?php

namespace App\Services;
use DateTime;

class DateFormater {

    public function timeElapsed($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'år',
            'm' => 'måned',
            'w' => 'uke',
            'd' => 'dag',
            'h' => 'time',
            'i' => 'minutt',
            's' => 'sekund',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'er' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' siden' : 'nå nettopp';
    }
}