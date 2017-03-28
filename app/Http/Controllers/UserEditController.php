<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Job;
use App\User;
use Validator;
use App\Study;
use App\Campus;
use App\Company;
use App\Professor;
use App\Assignment;
use App\StudentStudy;
use App\Http\Requests;
use App\Services\QuerryService;
use App\Http\Controllers\Controller;
use Chromabits\Purifier\Contracts\Purifier;

class UserEditController extends Controller
{
    /**
     * @var Purifier
     */
    protected $purifier;

    public function __construct(Purifier $purifier) {
        $this->middleware('auth');
        $this->purifier = $purifier;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (QuerryService $querry_service)
    {   
        if (Auth::user()->bruker_type == "student") {
            $brukerinfo = Auth::user();
            $student_studerer = StudentStudy::where('user_id', Auth::id())
                ->join('studies', 'student_studies.studie_id', '=', 'studies.id')
                ->get();
            $campuses = Campus::orderBy('campus', 'ASC')->get();

            return view('user.student.redigerBruker',
                [
                    'campuses' => $campuses,
                    'brukerinfo' => $brukerinfo,
                    'student_studerer' => $student_studerer
                ]);
        }

        else if (Auth::user()->bruker_type == "bedrift") {
            $brukerinfo = Auth::user();
            $company = Company::where('user_id', Auth::id())
                ->join('studies', 'companies.studie_id', '=', 'studies.id')
                ->get();

            $jobs = Job::where('bedrift_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

            $masters = Assignment::where('type', 'masteroppgave')
                ->where('bedrift_id', Auth::id())
                ->get();

            $bachelors = Assignment::where('type', 'bacheloroppgave')
                ->where('bedrift_id', Auth::id())
                ->get();

            $studies = Study::get();

            return view('user.bedrift.redigerBruker', [
                'brukerinfo'  => $brukerinfo,
                'bio'         => $brukerinfo->bio,
                'company'     => $company,
                'jobs'        => $jobs,
                'studies'     => $studies,
                'masters'     => $masters,
                'bachelors'   => $bachelors
            ]);
        }

        else if (Auth::user()->bruker_type == "faglarer") {
            $brukerinfo = User::where('users.id', Auth::id())
                ->firstOrFail();
            $myStudies = Professor::where('user_id', Auth::id())
                ->join('studies', 'professors.id', '=', 'studies.id')
                ->first();

            $studier = Study::where('campus', $brukerinfo->student_campus)
                ->get();
            $campuses = Campus::orderBy('campus', 'ASC')->get();

            return view('user.faglarer.redigerBruker', [
                'brukerinfo' => $brukerinfo,
                'studier'    => $studier,
                'campuses'   => $campuses,
                'myStudies'  => $myStudies
            ]);
        }
    }

    /**
     * Updates the usertable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user (id)
     * @return \Illuminate\Http\Response
     */
    public function updateUser (Request $request, User $user)
    {
        // Gets all data from form and pushes to DB
        $data = $request->all();
        $brukertype = Auth::user()->bruker_type;

        // exit if this is not your user and you are not admin
        if ($user->id !== Auth::id() && Auth::user()->bruker_type != "admin") {
            abort(403, 'Unauthorized action.');
        }

        if ($brukertype == "student") {
            /* Går gjennom valg (study, campus, år-fra->til) for studentretning */
            StudentStudy::where('user_id', Auth::id())->delete();
            
            if (isset($data['datoTil']) && isset($data['datoFra']) && isset($data['campus']) && isset($data['studyId'])) {
                for ($i = 0; $i < count($data['datoFra']); $i++) {
                    $studentStudy = New StudentStudy;
                    $studentStudy->user_id   = Auth::id();
                    $studentStudy->studie_id = $data['studyId'][$i];
                    $studentStudy->campus    = $data['campus'][$i];
                    $studentStudy->fra       = $data['datoFra'][$i];
                    $studentStudy->til       = $data['datoTil'][$i];
                    $studentStudy->save();
                }
            }
        }

        else if ($brukertype == "bedrift") {
            // Concatenates arrays to oneliners
            Company::where('user_id', Auth::id())->delete();

            if (!empty($data['studie_id'])) {
                for ($i = 0; $i < count($data['studie_id']); $i++) {
                    $company = New Company;
                    $company->user_id = Auth::id();
                    $company->studie_id = $data['studie_id'][$i];
                    $company->save();
                }
            }
            $data['bedrift_navn'] = $request->bedrift_navn;
        }

        else if ($brukertype == "faglarer") {
            Professor::where('user_id', Auth::id())->delete();

            if (array_key_exists('studie', $data)) {
                for ($i = 0; $i < count($data['studie']); $i++) {
                    $professor = New Professor;
                    $professor->user_id = Auth::id();
                    $professor->studie_id = $data['studie'][$i];
                    $professor->save();
                }
            }
        }

        else {
            abort(403, 'Unauthorized action.');
        }  

        // Sets phone nr to 0 if left blank
        if (empty($data['telefon'])) {
            $data['telefon'] = 0;
        }

        if ($brukertype == "student" || $brukertype == "bedrift") {
            // If the gived url does not contain http, append it.
            if (!preg_match('/http/', $data['nettside']) && $data['nettside'] != "") {
                $data['nettside'] = 'http://' . $data['nettside'];
            }
            if (!preg_match('/http/', $data['linkedin']) && $data['linkedin'] != "") {
                $data['linkedin'] = 'http://' . $data['linkedin'];
            }
            if (!preg_match('/http/', $data['facebook']) && $data['facebook'] != "") {
                $data['facebook'] = 'http://' . $data['facebook'];
            }
        }

        $data['bio'] = $this->purifier->clean($data['bio']);

        // Updates the DB with new data
        $user->update($data);

        //Redirect to prev page
        return back();      
    }

    /**
     * Removes the users Header Image from the DB restores it back to stdImg.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFrontImg (User $user)
    {
        $stdImg = "img/forsidebilder/" . $user->bruker_type . "_forsidebilde.jpg";

        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin" || $user->profilbilde != $stdImg) {
            
            $currentImg = $user->forsidebilde;

            // Deletes the current image
            if (file_exists('uploads/' . $currentImg)) {
                unlink("uploads/" . $currentImg);
            }

            // Sets the IMG back to standard
            $user = User::find(Auth::id());
            $user->forsidebilde = $stdImg;
            $user->save();

            return back();

        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Removes the users Profile Image from the DB restores it back to stdImg.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProfilImg (User $user)
    {
        $stdImg = "img/profilbilder/" . $user->bruker_type . "_profilbilde.png";

        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin" || $user->profilbilde != $stdImg) {
            
            $currentImg = $user->profilbilde;

            // Deletes the current image
            if (file_exists('uploads/' . $currentImg)) {
                unlink("uploads/" . $currentImg);
            }

            // Sets the IMG back to standard
            $user = User::find(Auth::id());
            $user->profilbilde = $stdImg;
            $user->save();

            return back();

        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
