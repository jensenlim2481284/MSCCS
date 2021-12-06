<?php

namespace App\Http\Controllers\MSCCS;

use DB;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Keyword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalysisController extends Controller
{


    # Analysis report page 
    public function index()
    {

        # Get statistic data 
        $ticket = Ticket::where('company_id', getCompany()->id);
        $totalCall = (clone $ticket)->count();
        $totalCustomer = User::where('company_id', getCompany()->id)->where('role_id', getConfig('role.customer'))->count();
 
        # Get Sentiment Compound 
        $completedTicket = (clone $ticket)->where('status', getConfig('ticket.status.completed'))->get();
        $neutral = $positive = $negative = 0;
        foreach($completedTicket as $record){
            $sentiment = (array)$record->getMeta('sentiment');   
            sort($sentiment);
            $negative += $sentiment[0]->score;    
            $neutral += $sentiment[1]->score;    
            $positive += $sentiment[2]->score;    
        }
        $count = $completedTicket->count();        
        $sentiment = ($count>0)?calculateCompound($positive/$count, $neutral/$count , $negative/$count, true):"ok";  
        $sentimentScore = ($count>0)?(calculateCompound($positive/$count, $neutral/$count , $negative/$count) * 100):50;  
        if($count <=0 ) $count = 1;
        
        # Get Call chart 
        $monthlyData = [];
        $monthlyRecord =  (clone $ticket)->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') new_date"), DB::raw('DAY(created_at) day'),DB::raw('count(*) as total'))->orderBy('new_date')->groupBy('day')->groupBy('new_date')->take(10)->get();            
        foreach($monthlyRecord as $record)        
            $monthlyData[] = ['label'=>$record->new_date, 'value' => $record->total ];
      
        # Get Keyword chart 
        $keywordData = [];
        $keywords = Keyword::where('company_id', getCompany()->id)->get();
        foreach($keywords as $keyword)
            $keywordData[] = ['label' => $keyword->value, 'value' => $keyword->ticket->count()];

        return view('pages.msccs.analysis', compact('ticket', 'sentiment', 'sentimentScore', 'monthlyData', 'totalCustomer', 'totalCall', 'positive', 'neutral', 'negative', 'count', 'keywordData'));
    }

}
