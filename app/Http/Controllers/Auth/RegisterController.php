<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Mail\ConfirmationEmail;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/bruker';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['bruker_type'] == "student") {
            return Validator::make($data, [
                'studRegFnavn'  => 'required|max:100',
                'studRegEnavn'  => 'required|max:100',
                'email'         => 'required|max:255|email|unique:users',
                'campus'        => 'required|max:100',
                'bruker_type'   => 'required',
                'password'      => 'required|max:100|min:6'
            ]);
        }
        else if ($data['bruker_type'] == "bedrift") {
            return Validator::make($data, [
                'bedRegNavn'    => 'required|max:100',
                'email'         => 'required|max:255|email|unique:users',
                'bruker_type'   => 'required',
                'password'      => 'required|max:100|min:6'
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        if ($data['bruker_type'] == "student") {

            return User::create([
                'fornavn' => $data['studRegFnavn'],
                'etternavn' => $data['studRegEnavn'],
                'email' => $data['email'],
                'student_campus' => $data['campus'],
                'bruker_type' => $data['bruker_type'],
                'password' => bcrypt($data['password']),
                'profilbilde' => 'img/profilbilder/student_profilbilde.jpg',
                'forsidebilde' => 'img/forsidebilder/student_forsidebilde.png'
            ]);
        } 

        else if ($data['bruker_type'] == "bedrift") {
            return User::create([
                'bedrift_navn' => $data['bedRegNavn'],
                'email' => $data['email'],
                'bruker_type' => $data['bruker_type'],
                'bedrift_avdeling' => $data['bedRegAvd'],
                'password' => bcrypt($data['password']),
                'profilbilde' => 'img/profilbilder/bedrift_profilbilde.png',
                'forsidebilde' => 'img/forsidebilder/bedrift_forsidebilde.jpg'
            ]);
        } 
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validates data through validator func
        $this->validator($request->all())->validate();

        // Creates user through create func
        event(new Registered($user = $this->create($request->all())));

        // Sends user a verify email
        Mail::to($user->email)->send(new ConfirmationEmail($user));

        // Returns back with a status message
        return back()->with('status', 'Takk for at du registrerte deg! Venligst sjekk eposten din for å aktivere brukeren.');
    }

    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->hasVerified();

        return redirect('/')->with('status', 'Din bruker er aktivert og du kan nå logge inn');
    }
}
