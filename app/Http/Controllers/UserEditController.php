<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Services\QuerryService;

class UserEditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuerryService $querry_service)
    {
        if (Auth::user()->bruker_type == "student") {
            $brukerinfo = Auth::user();
            $student_studerer = $querry_service->student_studerer($brukerinfo->student_studerer);


            return view('bruker.student.redigerBruker',
                [
                    'brukerinfo' => $brukerinfo,
                    'student_studerer' => $student_studerer
                ]);
        }

        else if (Auth::user()->bruker_type == "bedrift") {
            $brukerinfo = Auth::user();
            if (!empty(Auth::user()->bedrift_ser_etter)) {
                $bedrift_ser_etter = explode(";", Auth::user()->bedrift_ser_etter);
            }

            return view('bruker.bedrift.redigerBruker',
                [
                    'brukerinfo' => $brukerinfo,
                    'bedrift_ser_etter' => $bedrift_ser_etter
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
    public function updateUser(Request $request, User $user)
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
            if (isset($data['datoTil']) && isset($data['datoFra']) && isset($data['campus']) && isset($data['student_studerer'])) {
                // -1 because the index starts at 0
                $len = count($data['datoTil']) -1;
                for ($i = 0; $i <= $len; $i++) {
                    /* Dropper skilletegn på siste input i array */
                    if ($i === $len) {
                        $student_studerer .= $data['student_studerer'][$i] . ":" . $data['campus'][$i] . ":" . $data['datoFra'][$i] . ":" . $data['datoTil'][$i];
                    } else {
                        $student_studerer .= $data['student_studerer'][$i] . ":" . $data['campus'][$i] . ":" . $data['datoFra'][$i] . ":" . $data['datoTil'][$i] . ";";
                    }
                }
            }

            // Adds contacenated data to Request data array
            $data['student_studerer'] = $student_studerer;
        }

        else if (Auth::user()->bruker_type == "bedrift") {
            // Concatenates arrays to oneliners
            if (!empty($data['bedrift_ser_etter'])) {
                $bedrift_ser_etter = "";
                $i = 0;
                $len = count($data['bedrift_ser_etter']);
                
                foreach ($data['bedrift_ser_etter'] as $value) {
                    // Last element in array. Wont add ";"
                    if ($i == $len - 1) {
                        $bedrift_ser_etter .= $value;
                    } else {
                        $bedrift_ser_etter .= $value . ";";
                    }
                    $i++;
                }
                $data['bedrift_ser_etter'] = $bedrift_ser_etter;
            }
        }

        else if (Auth::user()->bruker_type == "faglarer") {

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
    public function deleteFrontImg(User $user)
    {
        $stdImg = "img/forsidebilder/" . $user->bruker_type . "_forsidebilde.jpg";

        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin" || $user->profilbilde != $stdImg) {
            
            $currentImg = $user->forsidebilde;

            // Deletes the current image
            unlink("uploads/" . $currentImg);

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
    public function deleteProfilImg(User $user)
    {
        $stdImg = "img/profilbilder/" . $user->bruker_type . "_profilbilde.png";

        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin" || $user->profilbilde != $stdImg) {
            
            $currentImg = $user->profilbilde;

            // Deletes the current image
            unlink("uploads/" . $currentImg);

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
