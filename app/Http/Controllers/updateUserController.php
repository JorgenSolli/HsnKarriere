<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\updateUser;

class updateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brukerinfo = Auth::user();
        return view('bruker.redigerBruker',
            [
                'brukerinfo' => $brukerinfo
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Post::findOrFail($id);
        
        $user->bio = $request->bio;
        $user->fornavn = $request->fornavn;
        $user->etternavn = $request->etternavn;
        $user->adresse = $request->adresse;
        $user->postNr = $request->postNr;
        $user->poststed = $request->poststed;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->facebook = $request->facebook;
        $user->linkedin = $request->linkedin;
        $user->studiested = $request->studiested;
        $user->studretning = $request->studretning;
        $user->campus = $request->campus;
        $user->datoFra = $request->datoFra;
        $user->datoTil = $request->datoTil;

        $user->save();

        //updateUser::update(Request::all(), Auth::id());
        return "success";
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
