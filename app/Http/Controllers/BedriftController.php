<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Job;
use App\User;
use App\Company;
use App\Assignment;

class BedriftController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Bedrift Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles handles everything that a user with the usertype
    | 'company'. It interacts with the database and handles all redirects and
    | error trapping
    |
    */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Adds a job to the DB
     *
     * @param  collection $request
     * @param  collection $user the current user
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Edits a job in the DB
     *
     * @param  collection $request
     * @param  collection $job the current job
     * @return \Illuminate\Http\Response
     */
    public function editJob (Request $request, Job $job)
    {
        if ($job->bedrift_id == Auth::id() || Auth::User()->bruker_type == "admin") {

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

            $job->id                = $job->id;
            $job->bedrift_id        = $job->bedrift_id;
            $job->sted              = $request->stilling_sted;
            $job->varighet_int      = $request->stilling_varighetInt;
            $job->varighet_prefix   = $request->stilling_varighetPrefix;
            $job->type              = $request->stilling_type;
            $job->frist             = $request->stilling_frist;
            $job->stilling_tittel   = $request->stilling_tittel;
            $job->bransje           = $request->stilling_bransje;
            $job->info              = $request->stilling_info;

            $job->update();

            return back()->with('success', 'Stillingen ble endret!');
        } else {
            abort(403, "No access!");
        }
        return back()->with('danger', 'Noe gikk galt.. Venligst prøv igjen.');
    }

    /**
     * Views a specific job
     *
     * @param  collection $job current job
     * @param  int $jobId the ID of the current job
     * @return \Illuminate\Http\Response
     */
    public function seeJob (Job $job, $jobId)
    {
        $brukerinfo = Auth::user();
        
        $bedrift_fagfelt = Company::where('user_id', Auth::id());

        $job = $job->where('id', $jobId)->first();

        $returnHTML = view('partials.user.bedrift.seeJob')
                ->with('job', $job)
                ->with('brukerinfo', $brukerinfo)
                ->with('bedrift_fagfelt', $bedrift_fagfelt)
                ->render();
        return response()->json(array('success' => true, 'job'=>$returnHTML));
    }

    /**
     * Deletes a job in the DB
     *
     * @param  collection $job the current job
     * @return \Illuminate\Http\Response
     */
    public function destroyJob (Job $job)
    {    
        if ($job->bedrift_id == Auth::id() || Auth::user()->bruker_type == "admin") {
            $job = Job::find($job->id);
            $job->delete();

            return back()->with('success', 'Stillingen ble slettet');
        } else {
            abort(403, 'Access denied');
        }
    }

    /**
     * Adds an master assignment in the DB
     *
     * @param collection $request
     * @param collection $user the current user
     * @return \Illuminate\Http\Response
     */
    public function addMaster (Request $request, User $user)
    {
        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin") {
            $validator = Validator::make($request->all(), [
                'masteroppgave-file'    => 'required',
                'master_tittel'         => 'required',
                'master_info'           => 'required',
                'master_fagfelt'        => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('danger', 'Alle felt må fylles ut!');
            }

            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('masteroppgave-file')->getClientOriginalName();
            $file       = $request->file('masteroppgave-file');
            $path       = $file->store('/assignments/masters');

            $assignment  = New Assignment;

            $assignment->fil        = $path;
            $assignment->filnavn    = $filename;
            $assignment->bedrift_id = $user->id;
            $assignment->type       = "masteroppgave";
            $assignment->tittel     = $request->master_tittel;
            $assignment->info       = $request->master_info;
            $assignment->fagfelt    = $request->master_fagfelt;

            $assignment->save();

            return back()->with('success', 'Masteroppgaven har blitt lagt til.');
        }
        else {
            abort(403);
        }
    }

    /**
     * Views a specific master assignment
     *
     * @param  collection $assignment
     * @return \Illuminate\Http\Response
     */
    public function seeMaster (Assignment $assignment)
    {
        $brukerinfo = Auth::user();
        
        $bedrift_fagfelt = Company::where('user_id', Auth::id());

        $returnHTML = view('partials.user.bedrift.seeMaster')
                ->with('assignment', $assignment)
                ->with('brukerinfo', $brukerinfo)
                ->with('bedrift_fagfelt', $bedrift_fagfelt)
                ->render();
        return response()->json(array('success' => true, 'assignment'=>$returnHTML));
    }

    /**
     * Edit a specific master assignment
     *
     * @param  collection $request
     * @param  collection $assignment
     * @return \Illuminate\Http\Response
     */
    public function editMaster (Request $request, Assignment $assignment)
    {
        $validator = Validator::make($request->all(), [
            'master_tittel'         => 'required',
            'master_info'           => 'required',
            'master_fagfelt'        => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('danger', 'Alle felt (unntatt fil) må fylles ut!');
        }

        // The user did not change the file
        if ($request->file('masteroppgave-file') == "") {
            $filename = $assignment->filnavn;
            $path = $assignment->fil;
        } else {
            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('masteroppgave-file')->getClientOriginalName();
            $file       = $request->file('masteroppgave-file');
            $path       = $file->store('/assignments/masters');
        }

        $assignment->id         = $assignment->id;
        $assignment->fil        = $path;
        $assignment->filnavn    = $filename;
        $assignment->bedrift_id = $assignment->bedrift_id;
        $assignment->type       = "masteroppgave";
        $assignment->tittel     = $request->master_tittel;
        $assignment->info       = $request->master_info;
        $assignment->fagfelt    = $request->master_fagfelt;

        $assignment->update();

        return back()->with('success', 'Masteroppgaven ble endret.');
    }

    /**
     * Deletes a specific master assignment
     *
     * @param  collection $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroyMaster (Assignment $assignment) 
    {

        if ($assignment->bedrift_id == Auth::id() || Auth::user()->bruker_type == "admin") {

            // Gets the file for unlink()
            $file = $assignment->fil;
            // Deletes the document
            if (file_exists("uploads/" . $file)) {
                unlink("uploads/" . $file);
            }

            $assignment->delete();

            return back()->with('success', 'Masteroppgaven ble slettet');
        } else {
            abort(403, 'Access denied');
        }
    }

    /**
     * Adds a specific bachelor assignment
     *
     * @param  collection $request
     * @param  collection $user
     * @return \Illuminate\Http\Response
     */
    public function addBachelor (Request $request, User $user)
    {
        if ($user->id == Auth::id() || Auth::user()->bruker_type == "admin") {
            $validator = Validator::make($request->all(), [
                'bacheloroppgave-file'  => 'required',
                'bachelor_tittel'       => 'required',
                'bachelor_info'         => 'required',
                'bachelor_fagfelt'      => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('danger', 'Alle felt må fylles ut!');
            }

            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('bacheloroppgave-file')->getClientOriginalName();
            $file       = $request->file('bacheloroppgave-file');
            $path       = $file->store('/assignments/bachelors');

            $assignment  = New Assignment;

            $assignment->fil             = $path;
            $assignment->filnavn         = $filename;
            $assignment->bedrift_id      = $user->id;
            $assignment->type            = "bacheloroppgave";
            $assignment->tittel          = $request->bachelor_tittel;
            $assignment->info            = $request->bachelor_info;
            $assignment->fagfelt        = $request->bachelor_fagfelt;

            $assignment->save();

            return back()->with('success', 'Bacheloroppgaven har blitt lagt til.');
        }
        else {
            abort(403);
        }
    }

    /**
     * Views a specific bachelor assignment
     *
     * @param  collection $assignment
     * @param  int @assignmentId the ID of the assignment
     * @return \Illuminate\Http\Response
     */
    public function seeBachelor (Assignment $assignment, $assignmentId)
    {
        $brukerinfo = Auth::user();
        
        $bedrift_fagfelt = Company::where('user_id', Auth::id());

        $assignment = $assignment->where('id', $assignmentId)->first();

        $returnHTML = view('partials.user.bedrift.seeBachelor')
                ->with('assignment', $assignment)
                ->with('brukerinfo', $brukerinfo)
                ->with('bedrift_fagfelt', $bedrift_fagfelt)
                ->render();
        return response()->json(array('success' => true, 'assignment'=>$returnHTML));
    }

    /**
     * Edit a specific bachelor assignment
     *
     * @param  collection $request
     * @param  collection $assignment
     * @return \Illuminate\Http\Response
     */
    public function editBachelor (Request $request, Assignment $assignment)
    {
        $validator = Validator::make($request->all(), [
            'bachelor_tittel'   => 'required',
            'bachelor_info'     => 'required',
            'bachelor_fagfelt'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('danger', 'Alle felt (unntatt fil) må fylles ut!');
        }

        // The user did not change the file
        if ($request->file('bacheloroppgave-file') == "") {
            $filename = $assignment->filnavn;
            $path = $assignment->fil;
        } else {
            // Gets file, uplads it, and store the path and filename
            $filename   = $request->file('bacheloroppgave-file')->getClientOriginalName();
            $file       = $request->file('bacheloroppgave-file');
            $path       = $file->store('/assignments/bachelors');
        }

        $assignment->id         = $assignment->id;
        $assignment->fil        = $path;
        $assignment->filnavn    = $filename;
        $assignment->bedrift_id = $assignment->bedrift_id;
        $assignment->type       = "bacheloroppgave";
        $assignment->tittel     = $request->bachelor_tittel;
        $assignment->info       = $request->bachelor_info;
        $assignment->fagfelt    = $request->bachelor_fagfelt;

        $assignment->update();

        return back()->with('success', 'Bacheloroppgaven ble endret.');
    }

    /**
     * Deletes a specific bachelor assignment
     *
     * @param  collection $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroyBachelor (Assignment $assignment) 
    {
        if ($assignment->bedrift_id == Auth::id() || Auth::user()->bruker_type == "admin") {
            
            // Gets the file for unlink()
            $file = $assignment->fil;
            // Deletes the document
            if (file_exists("uploads/" . $file)) {
                unlink("uploads/" . $file);
            }

            $assignment->delete();

            return back()->with('success', 'Bacheloroppgaven ble slettet');
        } else {
            abort(403, 'Access denied');
        }
    }
}