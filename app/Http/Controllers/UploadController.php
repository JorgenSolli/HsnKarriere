<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Recommendation;
use App\Http\Requests;
use App\Classes\Slim;
use App\Partnership;
use Validator;
use App\User;
use App\Cv;

class UploadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
    * Updates the user headerimage
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadForsidebilde () {
        // Gets the file data
        $image = Slim::getImages('coverphoto');

        if (isset($image[0]['output']['data'])) {
            // Original file name
            $name = $image[0]['output']['name'];

            // Base64 of the image
            $data = $image[0]['output']['data'];

            // Server path
            $path = base_path() . '/public/uploads/img/forsidebilder';

            // Save the file to the server
            $file = Slim::saveFile($data, $name, $path);

            // Specity the web path to the image
            $imagePath = 'img/forsidebilder/' . $file['name'];

            // Save the data to the DB
            $user = User::findOrFail(Auth::id());
            $user->forsidebilde = $imagePath;
            $user->save();
           
           return back()->with('success', 'Forsidebildet ditt er nå endret.');
        } else {
            return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
        }
    }

    /**
    * Updates the user avatar
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadProfilbilde (Request $request) {

    	// Gets the file data
        $image = Slim::getImages('avatar');

        if (isset($image[0]['output']['data'])) {
            // Original file name
            $name = $image[0]['output']['name'];

            // Base64 of the image
            $data = $image[0]['output']['data'];

            // Server path
            $path = base_path() . '/public/uploads/img/profilbilder';

            // Save the file to the server
            $file = Slim::saveFile($data, $name, $path);

            // Specity the web path to the image
            $imagePath = 'img/profilbilder/' . $file['name'];

            // Save the data to the DB
            $user = User::findOrFail(Auth::id());
            $user->profilbilde = $imagePath;
            $user->save();
    	   
           return back()->with('success', 'Profilbildet ditt er nå endret.');
        } else {
            return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
        }
    }

    /**
    * Uploads the contract for a partnership
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadContract (Partnership $partnership, Request $request) {
        $bruker_type = Auth::user()->bruker_type;
        $bruker_id = Auth::id();
        $currContract = $partnership->kontrakt;

        // Check if you're stil able to upload the contract. If the company has either signed the contract or has uploaded their jobdescription the stundent wont be allowed to upload another contract.
        if ($bruker_type == "student" && $partnership->signert_av_bedrift == 1 && $partnership->kontrakt_rejected == 0) {
            return back()->with('danger', 'Kontrakten er allerede signert av bedriften. Du kan ikke laste opp ny nå.');
        }

        if ($bruker_type == "bedrift" && $partnership->arbeidsbesk > "" && $partnership->arbeidsbesk_rejected == 0 && $partnership->kontrakt_rejected == 0) {
            return back()->with('danger', 'Kontrakten er allerede sendt inn til godkjenning. Du kan ikke laste opp ny nå.');
        }

        if (($bruker_type == "student" && $partnership->student_id == $bruker_id)
            || ($bruker_type == "bedrift" && $partnership->bedrift_id == $bruker_id)) {
            // Removes old contract
            if ($currContract != "" && file_exists('uploads/' . $currContract)) {
                unlink("uploads/" . $currContract);
            }

            // Removed old rejected message and boolean value
            if ($partnership->kontrakt_rejected == 1) {
                $partnership->kontrakt_rejected = 0;
            }

            // Gets file, uplads it, and stores the path and filename
            $file = request()->file('kontrakt');
            $path = $file->store('kontrakter/signert');

            $partnership->kontrakt = $path;
            if ($bruker_type == "student") {
                $partnership->signert_av_student = 1;
            } elseif ($bruker_type == "bedrift") {
                $partnership->signert_av_bedrift = 1;
            }
            $partnership->save();

            return back()->with('success', 'Kontrakten ble lastet opp.');
        }

        return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
    }

    /**
    * Uploads the contract for a partnership
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadJobDescription (Partnership $partnership, Request $request) {
        $bruker_type = Auth::user()->bruker_type;
        $bruker_id = Auth::id();
        $currDesc = $partnership->arbeidsbesk;

        if ($partnership->arbeidsbesk > "" && $partnership->arbeidsbesk_rejected == 0) {
            return back()->with('danger', 'Du har alerede lastet opp en arbeidsbeskrivelse.');
        }

        if ($bruker_type == "bedrift" && $partnership->bedrift_id == $bruker_id) {
            // Removes old contract
            if ($currDesc != "" && file_exists('uploads/' . $currDesc)) {
                unlink("uploads/" . $currDesc);
            }

            // Removed old rejected message and boolean value
            if ($partnership->arbeidsbesk_rejected == 1) {
                $partnership->arbeidsbesk_rejected = 0;
            }

            // Gets file, uplads it, and stores the path and filename
            $file = request()->file('arbeidsbesk');
            $path = $file->store('arbeidsbeskrivelse');
            $partnership->arbeidsbesk = $path;
            $partnership->save();

            return back()->with('success', 'Arbeidsbeskrivelsen ble lastet opp.');
        }

        return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
    }

    /**
    * Uploads the CV for a student
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadCv (Request $request) {

        if (Auth::user()->bruker_type == "student") {
            $validator = Validator::make($request->all(), [
                'cv_file'    => 'required',
                'cv_tittel'  => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('danger', 'Alle felt må fylles ut!');
            }

            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('cv_file')->getClientOriginalName();
            $file       = $request->file('cv_file');
            $path       = $file->store('/cvs');

            $cv  = New Cv;

            $cv->cv         = $path;
            $cv->filnavn    = $filename;
            $cv->user_id    = Auth::id();
            $cv->title      = $request->cv_tittel;

            $cv->save();

            return back()->with('success', 'CVen har blitt lagt til.');
        }

        return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
    }

    /**
    * Uploads the CV for a student
    *
    * @return \Illuminate\Http\Response
    */
    public function uploadRecommendation (Request $request) {

        if (Auth::user()->bruker_type == "student") {
            $validator = Validator::make($request->all(), [
                'recommendation_file'    => 'required',
                'recommendation_tittel'  => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('danger', 'Alle felt må fylles ut!');
            }

            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('recommendation_file')->getClientOriginalName();
            $file       = $request->file('recommendation_file');
            $path       = $file->store('/recommendations');

            $recommendation  = New Recommendation;

            $recommendation->recommendation = $path;
            $recommendation->filnavn        = $filename;
            $recommendation->user_id        = Auth::id();
            $recommendation->title          = $request->recommendation_tittel;

            $recommendation->save();

            return back()->with('success', 'Attesten har blitt lagt til.');
        }

        return back()->with('danger', 'Noe gikk galt. Venligst prøv igjen.');
    }
}