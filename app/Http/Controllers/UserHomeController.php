<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuerryService;
use App\Job;
use App\Company;
use App\Professor;
use App\Assignment;
use App\StudentStudy;

class UserHomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function bruker(QuerryService $querry_service) {
        if (Auth::user()->bruker_type == "student") {
        
            $brukerinfo = Auth::user();
            $student_studerer = StudentStudy::where('user_id', Auth::id())
                ->select('studie')
                ->get();
            $bedrifter  = $querry_service->finnBedrifter($student_studerer, false);
            $kontakter  = $querry_service->finnKontakter($student_studerer, false);

            return view('user.student.bruker', 
                [
                    'bedrifter' => $bedrifter, 
                    'kontakter' => $kontakter,
                    'student_studerer' => $student_studerer,
                    'brukerinfo' => $brukerinfo
                ]);
        }
        else if (Auth::user()->bruker_type == "bedrift") {

            $brukerinfo = Auth::user();
            $company = Company::where('user_id', Auth::id());
            $studenter = $querry_service->finnStudenter(Company::select('area_of_expertise')->where('user_id', Auth::id())->get(), "");
            
            return view('user.bedrift.bruker',
                [
                    'studenter'  => $studenter,
                    'company'    => $company,
                    'brukerinfo' => $brukerinfo
                ]);
        } 
        else if (Auth::user()->bruker_type == "faglarer") {
            $brukerinfo = Auth::user();
            $studier = Professor::where('user_id', Auth::id())->get();
            $studenter = "";
            $bedrifter = "";
            return view('user.faglarer.bruker', [
                'brukerinfo' => $brukerinfo,
                'studier'    => $studier,
                'studenter'  => $studenter,
                'bedrifter'  => $bedrifter
            ]);
        }
	}

    public function seBruker(QuerryService $querry_service, $id) {
        $brukerinfo = DB::table('users')->where('id', $id)->first();

        if ($brukerinfo->bruker_type == "student") {
            $student_studerer = StudentStudy::where('user_id', $id)
                ->get();
            
            return view('user.student.seBruker',
            [
                'student_studerer' => $student_studerer,
                'brukerinfo' => $brukerinfo
            ]);
        }

        else if ($brukerinfo->bruker_type == "bedrift") {
            $jobs = Job::where('bedrift_id', $id)->orderBy('created_at', 'desc')->get();
            $company = Company::where('user_id', $id)->get();
            $masters = Assignment::where('type', 'masteroppgave')->where('bedrift_id', $id)->get();
            $bachelors = Assignment::where('type', 'bacheloroppgave')->where('bedrift_id', $id)->get();

            $studier = StudentStudy::where('user_id', Auth::id())
                ->select('studie')
                ->get();
            $faglarere = $querry_service->finnKontakter($studier);
            return view('user.bedrift.seBruker',
            [
                'brukerinfo' => $brukerinfo,
                'faglarere'  => $faglarere,
                'company'    => $company, 
                'bachelors'  => $bachelors,
                'masters'    => $masters,
                'jobs'       => $jobs
            ]);
        }

        else if ($brukerinfo->bruker_type == "faglarer") {
            return view('user.faglarer.seBruker',
            [
                'brukerinfo' => $brukerinfo
            ]);
        }

        
    }
}
