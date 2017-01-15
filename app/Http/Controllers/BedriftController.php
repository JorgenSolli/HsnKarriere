<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Job;
use Validator;

class BedriftController extends Controller
{
    public function addJob (Request $request, User $user)
    {
        if ($user->id == Auth::id() || Auth::User()->bruker_type == "admin") {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'stilling_sted'             => 'required',
                'stilling_varighetInt'      => 'required',
                'stilling_varighetPrefix'   => 'required',
                'stilling_type'             => 'required',
                'stilling_frist'            => 'required',
                'stilling_tittel'           => 'required',
                'stilling_bransje'          => 'required',
                'stilling_info'             => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('danger', 'Alle felt må fylles ut!');
            }

            $job = new Job;

            $job->bedrift_id        = Auth::id();
            $job->sted              = $request->stilling_sted;
            $job->varighet_int      = $request->stilling_varighetInt;
            $job->varighet_prefix   = $request->stilling_varighetPrefix;
            $job->type              = $request->stilling_type;
            $job->frist             = $request->stilling_frist;
            $job->stilling_tittel   = $request->stilling_tittel;
            $job->bransje           = $request->stilling_bransje;
            $job->info              = $request->stilling_info;

            $job->save();

            return back()->with('success', 'Stillingen er lagt til!');
        } else {
            abort(403, "No access!");
        }
        return back()->with('danger', 'Noe gikk galt.. Venligst prøv igjen.');
    }

    public function editJob (Job $job)
    {

    }

    // Returns the data to a AJAX call
    public function seeJob (Job $job, $jobId) {
        $brukerinfo = Auth::user();
        
        if (!empty(Auth::user()->bedrift_fagfelt)) {
            $bedrift_fagfelt = explode(";", Auth::user()->bedrift_fagfelt);
        } else {
            $bedrift_fagfelt = "";
        }

        $job = $job->where('id', $jobId)->first();

        $returnHTML = view('includes.bruker.bedrift.seeJob')
                ->with('job', $job)
                ->with('brukerinfo', $brukerinfo)
                ->with('bedrift_fagfelt', $bedrift_fagfelt)
                ->render();
        return response()->json(array('success' => true, 'job'=>$returnHTML));
    }
}
