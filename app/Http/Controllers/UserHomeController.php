<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuerryService;

class UserHomeController extends Controller
{
    public function bruker(QuerryService $querry_service) {
        if (Auth::user()->bruker_type == "student") {
        
            $brukerinfo = Auth::user();
            $bedrifter  = $querry_service->finnBedrifter($brukerinfo->student_studerer);
            $kontakter  = "";
            $student_studerer = $querry_service->student_studerer($brukerinfo->student_studerer);

            return view('bruker.student.bruker', 
                [
                    'bedrifter' => $bedrifter, 
                    'kontakter' => $kontakter,
                    'student_studerer' => $student_studerer,
                    'brukerinfo' => $brukerinfo
                ]);
        }
        else if (Auth::user()->bruker_type == "bedrift") {

            $brukerinfo = Auth::user();
            $studenter = $querry_service->finnStudenter($brukerinfo->bedrift_ser_etter);

            return view('bruker.bedrift.bruker',
                [
                    'studenter' => $studenter,
                    'brukerinfo' => $brukerinfo
                ]);
        }
	}

    public function seBruker(QuerryService $querry_service, $id) {
        $brukerinfo = DB::table('users')->where('id', $id)->first();

        if ($brukerinfo->bruker_type == "student") {
            $student_studerer = $student_studerer = array_chunk(preg_split('/(:|;)/', $brukerinfo
                ->student_studerer), 4);
            
            return view('bruker.student.seBruker',
            [
                'student_studerer' => $student_studerer,
                'brukerinfo' => $brukerinfo
            ]);
        }

        else if ($brukerinfo->bruker_type == "bedrift") {
            return view('bruker.bedrift.seBruker',
            [
                'brukerinfo' => $brukerinfo
            ]);
        }

        else if ($brukerinfo->bruker_type == "faglarer") {
            return view('bruker.faglarer.seBruker',
            [
                'brukerinfo' => $brukerinfo
            ]);
        }

        
    }
}
