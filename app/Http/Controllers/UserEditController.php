<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Job;
use App\User;
use Validator;
use App\Company;
use App\Professor;
use App\Assignment;
use App\StudentStudy;
use App\Http\Requests;
use App\Services\QuerryService;
use App\Http\Controllers\Controller;

class UserEditController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
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
            $student_studerer = StudentStudy::where('user_id', Auth::id())->get();


            return view('bruker.student.redigerBruker',
                [
                    'brukerinfo' => $brukerinfo,
                    'student_studerer' => $student_studerer
                ]);
        }

        else if (Auth::user()->bruker_type == "bedrift") {
            $brukerinfo = Auth::user();
            $company = Company::where('user_id', Auth::id())->get();
            $jobs = Job::where('bedrift_id', Auth::id())->orderBy('created_at', 'desc')->get();
            $masters = Assignment::where('type', 'masteroppgave')->where('bedrift_id', Auth::id())->get();
            $bachelors = Assignment::where('type', 'bacheloroppgave')->where('bedrift_id', Auth::id())->get();

            return view('bruker.bedrift.redigerBruker', [
                'brukerinfo'  => $brukerinfo,
                'company'     => $company,
                'jobs'        => $jobs,
                'masters'     => $masters,
                'bachelors'   => $bachelors
            ]);
        }

        else if (Auth::user()->bruker_type == "faglarer") {
            $brukerinfo = Auth::user();
            $studier = Professor::where('user_id', Auth::id())->get();

            return view('bruker.faglarer.redigerBruker', [
                'brukerinfo' => $brukerinfo,
                'studier'    => $studier
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

        // exit if this is not your user and you are not admin
        if ($user->id !== Auth::id() && Auth::user()->bruker_type != "admin") {
            abort(403, 'Unauthorized action.');
        }

        if (Auth::user()->bruker_type == "student") {
            // Formats the data for the student_studerer field. Concats studretning, campus, datoFra og datoTil
            $student_studerer = NULL;
            /* Går gjennom valg (student_studerer, campus, år-fra->til) for studentretning */
            StudentStudy::where('user_id', Auth::id())->delete();
            if (isset($data['datoTil']) && isset($data['datoFra']) && isset($data['campus']) && isset($data['student_studerer'])) {

                
                for ($i = 0; $i < count($data['datoFra']); $i++) {
                    $studentStudy = New StudentStudy;

                    $studentStudy->user_id  = Auth::id();
                    $studentStudy->studie   = $data['student_studerer'][$i];
                    $studentStudy->campus   = $data['campus'][$i];
                    $studentStudy->fra      = $data['datoFra'][$i];
                    $studentStudy->til      = $data['datoTil'][$i];
                    $studentStudy->save();
                }
            }

            // Adds contacenated data to Request data array
            $data['student_studerer'] = $student_studerer;
        }

        else if (Auth::user()->bruker_type == "bedrift") {
            // Concatenates arrays to oneliners
            Company::where('user_id', Auth::id())->delete();
            if (!empty($data['area_of_expertise'])) {
                for ($i = 0; $i < count($data['area_of_expertise']); $i++) {
                    $company = New Company;
                    $company->user_id = Auth::id();
                    $company->area_of_expertise = $data['area_of_expertise'][$i];
                    $company->save();
                }
            }
            $data['bedrift_navn'] = $request->bedrift_navn;
        }

        else if (Auth::user()->bruker_type == "faglarer") {
            Professor::where('user_id', Auth::id())->delete();
            if (!empty($data['studie'])) {
                for ($i = 0; $i < count($data['studie']); $i++) {
                    $professor = New Professor;
                    $professor->user_id = Auth::id();
                    $professor->studie = $data['studie'][$i];
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
