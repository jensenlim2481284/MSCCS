<?php

namespace App\Http\Controllers\MSCCS;

use Storage;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Company;
use App\Jobs\ProcessAudio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallController extends Controller
{

    
    # Call management index page
    public function index(Request $request)
    {
        $ticket = Ticket::first();
        ProcessAudio::dispatch(getConfig('ticket.stage.audio_pre_process'), $ticket);

        return view('pages.msccs.call.index');
    }
    
    
    # Call management view page
    public function view(Request $request)
    {
        return view('pages.msccs.call.view');
    }


    
    # Process audio
    public function processAudio(Request $request){

        # 1 : Retrieve audio BLOB data , create & store WAV file ,  retrieve the file path
        $name = time().'.wav';
        Storage::put($name, file_get_contents($request->file('audioBlob')));
        $path = Storage::path($name);

        # 2 : Retrieve company & user record - security validation
        $user = User::whereUID($request->userID);
        $company = Company::whereUID($request->companyID);
        if($user->company_id != $company->id) abort(404);

        # 3 : Create ticket record 
        $ticket = Ticket::create([
            'company_id' => $company->id,
            'audio_path'=> $path
        ]);   

        # 4 : Process audio 
        ProcessAudio::dispatch(getConfig('ticket.stage.audio_pre_process'), $ticket);

    }


}
