<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\QuerryService;
use App\Cv;
use App\Job;
use App\User;
use App\Company;
use App\Professor;
use App\Assignment;
use App\Partnership;
use App\StudentStudy;
use App\Recommendation;

class UserHomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function bruker(QuerryService $querry_service) {
        if (Auth::user()->bruker_type == "student") {
        
            $brukerinfo = Auth::user();
            $bedrifter = $querry_service->finnBedrifter(Auth::id(), false, false);
            $forelesere = $querry_service->finnForeleser(Auth::id(), false, Auth::id());
            $student_studerer = StudentStudy::where('user_id', Auth::id())
                ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                ->get();
            $recommendations = Recommendation::where('user_id', Auth::id())->get();
            $cv = Cv::where('user_id', Auth::id())->first();

            return view('user.student.bruker', 
                [
                    'bedrifter'  => $bedrifter, 
                    'forelesere' => $forelesere,
                    'student_studerer' => $student_studerer,
                    'brukerinfo' => $brukerinfo,
                    'recommendations' => $recommendations,
                    'cv' => $cv
                ]);
        }
        else if (Auth::user()->bruker_type == "bedrift") {
            $company = Company::where('user_id', Auth::id())->get();
            $brukerinfo = Auth::user();
            
            $fag = Company::where('user_id', Auth::id())
                ->join('studies', 'companies.studie_id', '=', 'studies.id')
                ->get();

            $jobs = Job::where('bedrift_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            $nr_jobs = Job::where('bedrift_id', Auth::id())
                ->count();

            $masters = Assignment::where('type', 'masteroppgave')
                ->where('bedrift_id', Auth::id())
                ->get();
            $nr_masters = Assignment::where('type', 'masteroppgave')
                ->where('bedrift_id', Auth::id())
                ->count();

            $bachelors = Assignment::where('type', 'bacheloroppgave')
                ->where('bedrift_id', Auth::id())
                ->get();
            $nr_bachelors = Assignment::where('type', 'bacheloroppgave')
                ->where('bedrift_id', Auth::id())
                ->count();

            $forelesere = $querry_service->finnForeleser(Auth::id(), false);

            $studenter = $querry_service
                ->finnStudenter(
                    Auth::id(), 
                    false, 
                    false
                );

            return view('user.bedrift.bruker',
                [
                    'brukerinfo'    => $brukerinfo,
                    'studenter'     => $studenter,      
                    'forelesere'    => $forelesere,
                    'company'       => $company,
                    'fag'           => $fag, 
                    'bachelors'     => $bachelors,
                    'nr_bachelors'  => $nr_bachelors,
                    'masters'       => $masters,
                    'nr_masters'    => $nr_masters,
                    'jobs'          => $jobs,
                    'nr_jobs'       => $nr_jobs
                ]);
        } 
        else if (Auth::user()->bruker_type == "faglarer") {
            $brukerinfo = Auth::user();
            $studie = Professor::where('user_id', Auth::id())
                ->join('studies', 'professors.studie_id', '=', 'studies.id')
                ->first();
            $studenter = $querry_service->finnStudenter(Auth::id(),false, false);
            $bedrifter = $querry_service->finnBedrifter(Auth::id(), false, false);

            return view('user.faglarer.bruker', [
                'brukerinfo' => $brukerinfo,
                'studie'     => $studie,
                'studenter'  => $studenter,
                'bedrifter'  => $bedrifter,
            ]);
        }
	}

    public function seBruker(QuerryService $querry_service, $id) {
        $brukerinfo = User::where('id', $id)
            ->firstOrFail();

        if ($brukerinfo->bruker_type == "student") {
            $student_studerer = StudentStudy::where('user_id', $id)
                ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                ->get();
            $faglarere = $querry_service->finnForeleser($id, false, false);

            // Are you in a partnership with this student?
            $inPartnership = Partnership::where([
                    ['student_id', '=', $id],
                    ['bedrift_id', '=', Auth::id()]
                ])
                ->first();

            $recommendations = Recommendation::where('user_id', $id)->get();
            $cv = Cv::where('user_id', $id)->first();

            return view('user.student.seBruker',
            [
                'student_studerer' => $student_studerer,
                'brukerinfo' => $brukerinfo,
                'faglarere' => $faglarere,
                'inPartnership' => $inPartnership,
                'recommendations' => $recommendations,
                'cv' => $cv
            ]);
        }

        else if ($brukerinfo->bruker_type == "bedrift") {
            $company = Company::where('user_id', $id)->get();

            $jobs = Job::where('bedrift_id', $id)->orderBy('created_at', 'desc')->get();
            $nr_jobs = Job::where('bedrift_id', $id)->count();

            $masters = Assignment::where('type', 'masteroppgave')->where('bedrift_id', $id)->get();
            $nr_masters = Assignment::where('type', 'masteroppgave')->where('bedrift_id', $id)->count();

            $bachelors = Assignment::where('type', 'bacheloroppgave')->where('bedrift_id', $id)->get();
            $nr_bachelors = Assignment::where('type', 'bacheloroppgave')->where('bedrift_id', $id)->count();

            $studier = Company::where('user_id', $id)
                ->join('studies', 'companies.studie_id', '=', 'studies.id')
                ->select('study')
                ->get();

            $faglarere = $querry_service->finnForeleser($id, false);

            return view('user.bedrift.seBruker',
            [
                'brukerinfo'    => $brukerinfo,
                'faglarere'     => $faglarere,
                'company'       => $company,
                'fag'           => $studier, 
                'bachelors'     => $bachelors,
                'nr_bachelors'  => $nr_bachelors,
                'masters'       => $masters,
                'nr_masters'    => $nr_masters,
                'jobs'          => $jobs,
                'nr_jobs'       => $nr_jobs
            ]);
        }

        else if ($brukerinfo->bruker_type == "faglarer") {
            $studie = Professor::where('user_id', $id)
                ->join('studies', 'professors.studie_id', '=', 'studies.id')
                ->select('study')
                ->first();

            return view('user.faglarer.seBruker',
            [
                'brukerinfo' => $brukerinfo,
                'studie'  => $studie
            ]);
        }   
    }
}
