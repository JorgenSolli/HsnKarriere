<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cv;
use App\Job;
use App\User;
use Validator;
use App\Study;
use App\Campus;
use App\Company;
use App\Professor;
use App\Assignment;
use App\Partnership;
use App\StudentStudy;
use App\Http\Requests;
use App\Recommendation;
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
            $cv = Cv::where('user_id', Auth::id())
                ->first();
            $recommendations = Recommendation::where('user_id', Auth::id())
                ->get();
            $recommendationsCount = Recommendation::where('user_id', Auth::id())
                ->count();

            $fag = StudentStudy::where('user_id', Auth::id())
                ->select('studie_id')
                ->get();

            // Gets two random comapnies
            $rndCompanies = Company::select(
                    'user_id', 
                    'bedrift_navn', 
                    'fornavn', 
                    'etternavn', 
                    'forsidebilde', 
                    'profilbilde', 
                    'email', 
                    'telefon', 
                    'poststed', 
                    'studie_id'
                )
                ->join('users', 'companies.user_id', '=', 'users.id')
                ->whereIn('studie_id', $fag)
                ->inRandomOrder()
                ->limit(2)
                ->get()
                ->unique('user_id');

            return view('user.student.redigerBruker',
                [
                    'cv' => $cv,
                    'campuses' => $campuses,
                    'brukerinfo' => $brukerinfo,
                    'recommendations' => $recommendations,
                    'recommendationsCount' => $recommendationsCount,
                    'student_studerer' => $student_studerer,
                    'rndCompanies' => $rndCompanies,
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

            $fag = Company::where('user_id', Auth::id())
                    ->select('studie_id')
                    ->get();

            // Gets two random students
            $rndStudents = StudentStudy::select(
                    'email', 
                    'user_id', 
                    'telefon', 
                    'fornavn', 
                    'poststed', 
                    'etternavn', 
                    'studie_id',
                    'forsidebilde', 
                    'profilbilde')
                ->join('users', 'student_studies.user_id', '=', 'users.id')
                ->whereIn('studie_id', $fag)
                ->inRandomOrder()
                ->limit(2)
                ->get()
                ->unique('user_id');

            return view('user.bedrift.redigerBruker', [
                'brukerinfo'  => $brukerinfo,
                'bio'         => $brukerinfo->bio,
                'company'     => $company,
                'jobs'        => $jobs,
                'studies'     => $studies,
                'masters'     => $masters,
                'bachelors'   => $bachelors,
                'rndStudents' => $rndStudents
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

            $nrStudents = count($querry_service->finnStudenter(Auth::id(),false, false));
            $nrCompanies = count($querry_service->finnBedrifter(Auth::id(), false, false));

            $activePartnerships = Partnership::where([
                    ['foreleser_id', Auth::id()],
                    ['signert_av_bedrift', '1'],
                    ['signert_av_student', '1'],
                    ['kontrakt_godkjent_av_foreleser', '1'],
                ])
                ->join('users AS student', 'partnerships.student_id', '=', 'student.id')
                ->join('users AS bedrift', 'partnerships.bedrift_id', '=', 'bedrift.id')
                ->select('partnerships.type_samarbeid',
                         'partnerships.godkjent_av_student',
                         'partnerships.godkjent_av_foreleser',
                         'partnerships.godkjent_av_bedrift',
                         'partnerships.signert_av_student',
                         'partnerships.signert_av_bedrift',
                         'partnerships.kontrakt_godkjent_av_foreleser',
                         'partnerships.kontrakt',
                         'partnerships.kontrakt_rejected',
                         'partnerships.arbeidsbesk',
                         'partnerships.arbeidsbesk_rejected',
                         'partnerships.rejected_info',
                         'partnerships.startdato',
                         'partnerships.created_at',
                         'partnerships.updated_at',
                         'partnerships.id',
                         'student.fornavn AS student_fornavn',
                         'student.etternavn AS student_etternavn',
                         'student.id AS student_id',
                         'bedrift.bedrift_navn AS bedrift_navn',
                         'bedrift.id AS bedrift_id')
                ->orderBy('partnerships.updated_at')
                ->get();

            return view('user.faglarer.redigerBruker', [
                'brukerinfo'         => $brukerinfo,
                'studier'            => $studier,
                'campuses'           => $campuses,
                'myStudies'          => $myStudies,
                'nrStudents'         => $nrStudents,
                'nrCompanies'        => $nrCompanies,
                'activePartnerships' => $activePartnerships,
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

            $checkEmail = User::where('email', $data['email'])
                ->where('id', '!=', Auth::id())
                ->first();

            if ($checkEmail) {
                return back()->with('danger', 'Eposten ' . $data['email'] . ' er allerede i bruk!');
            }
            
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

        // Faglarer does NOT have a bio
        if (!$brukertype == "faglarer") {
            $data['bio'] = $this->purifier->clean($data['bio']);
        }

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

    /**
     * Removes the users CV.
     *
     * @param  model  $cv
     * @return \Illuminate\Http\Response
     */
    public function deleteCv (Cv $cv)
    {
        if ($cv->user_id == Auth::id()) {
            // Deletes the current CV
            if (file_exists('uploads/' . $cv->cv)) {
                unlink("uploads/" . $cv->cv);

                // Removes the data from the DB
                $cv->delete();

                return back()->with('success', 'CVen ble slettet.');
            }

        }
        
        abort(403, 'Unauthorized action.');
    }

    /**
     * Removes the users CV.
     *
     * @param  model  $cv
     * @return \Illuminate\Http\Response
     */
    public function deleteRecommendation (Recommendation $recommendation)
    {   
        if ($recommendation->user_id == Auth::id()) {
            // Deletes the current CV
            if (file_exists('uploads/' . $recommendation->recommendation)) {
                unlink("uploads/" . $recommendation->recommendation);

                // Removes the data from the DB
                $recommendation->delete();

                return back()->with('success', 'Attesten ble slettet.');
            }

        }
        
        abort(403, 'Unauthorized action.');
    }
}
