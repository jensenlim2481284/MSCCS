<?php

namespace App\Http\Controllers\MSCCS;

use Storage;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Keyword;
use App\Models\Company;
use App\Jobs\ProcessAudio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallController extends Controller
{

    
    # Call management index page
    public function index(Request $request)
    {

        # 0 : Filter record		
        $records = Ticket::where('company_id', getCompany()->id);     
        $startDate = getFilterStartDate($request->startDate);
        $endDate = getFilterEndDate($request->endDate);        
        if($searchQuery = $request->input('query'))
            $records = $records->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', "%$searchQuery%")
                ->orWhere('transcript', 'like', "%$searchQuery%")
                ->orWhere('description', 'like', "%$searchQuery%");                
            });
            
        # 1 : Get data         
        $records = $records->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->orderBy('created_at','DESC')->get();

        return view('pages.msccs.call.index', compact('records'));
    }
    
    
    # Call management view page
    public function view($uid)
    {

        # Retrieve call record - check & validate permission 
        $ticket = Ticket::whereUID($uid);
        if(!$ticket && ($ticket->company_id !=  getCompany()->id)) abort(404);
        
        # Get Sentiment Compound 
        $sentiment = $ticket->getMeta('sentiment');
        asort($sentiment);
        $negative = $sentiment[0]->score;    
        $neutral = $sentiment[1]->score;    
        $positive = $sentiment[2]->score;        
        $sentiment = calculateCompound($positive, $neutral , $negative, true);  
        $sentimentScore = calculateCompound($positive, $neutral , $negative) * 100;  

        # Get Keyword chart 
        $keywordData = [];
        $keywords = Keyword::where('company_id', getCompany()->id)->get();
        foreach($keywords as $keyword)
            $keywordData[] = ['label' => $keyword->value, 'value' => $keyword->ticket->count()];

        return view('pages.msccs.call.view', compact('ticket', 'sentimentScore', 'sentiment', 'positive', 'neutral', 'negative', 'keywordData'));
    }


    # Upload audio
    public function upload(Request $request)
    {
        # 1 : Retrieve audio file and store 
        $name = time().'.wav';
        Storage::put($name, file_get_contents($request->file('audio')));
        $path = Storage::path($name);
        
        # 2 : Create ticket record 
        $ticket = Ticket::create([
            'company_id' => getCompany()->id,
            'audio_path'=> $path
        ]);   

        # 3 : Process audio 
        ProcessAudio::dispatch(getConfig('ticket.stage.audio_pre_process'), $ticket);


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


    # Update call record data
    public function update(Request $request){

        # Get call record & check permission
        $ticket = Ticket::whereUID($request->uid);
        if(!$ticket  && ($ticket->company_id != getCompany()->id)) abort(404);

        # Update data 
        $ticket->update($request->only(['title','description']));

        return back()->with('success',  'Call record updated');
    }



    # Function to delete call record 
    public function delete(Request $request){

        # Retrieve call record 
        $record = Ticket::whereUID($request->actionID);

        # Check record & permission
        if(!$record && ($record->company_id !=  getCompany()->id)) abort(404);

        # Delete record
        $record->delete();
        return back()->with('success',  'Call record deleted');

    }




}
