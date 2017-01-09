<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Services\QuerryService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuerryService $querry_service)
    {
        $brukerinfo = Auth::user();
        $student_studerer = $querry_service->student_studerer($brukerinfo->student_studerer);


        return view('bruker.redigerBruker',
            [
                'brukerinfo' => $brukerinfo,
                'student_studerer' => $student_studerer
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create asd!";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        // Updates the DB with new data
        $user->update($data);

        //Redirect to prev page
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
