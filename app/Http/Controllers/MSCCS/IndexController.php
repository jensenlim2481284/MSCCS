<?php

namespace App\Http\Controllers\MSCCS;

use DB;
use App\Models\User;
use App\Models\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{


    # Dashboard page 
    public function index()
    {

        # Get statistic data 
        $ticket = Ticket::where('company_id', getCompany()->id);
        $totalCall = (clone $ticket)->count();
        $totalCustomer = User::where('company_id', getCompany()->id)->where('role_id', getConfig('role.customer'))->count();

        # Get sentiment score 
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
        $sentiment = ($count > 0 )?calculateCompound($positive/$count, $neutral/$count , $negative/$count, true):'ok';  

        # Get call vs date 
        $monthlyData = [];
        $monthlyRecord =  (clone $ticket)->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') new_date"), DB::raw('DAY(created_at) day'),DB::raw('count(*) as total'))->orderBy('new_date')->groupBy('day')->groupBy('new_date')->take(10)->get();            
        foreach($monthlyRecord as $record)        
            $monthlyData[] = ['label'=>$record->new_date, 'value' => $record->total ];

        # Get recent activity
        $recentActivity = (clone $ticket)->orderBy('created_at', 'DESC')->take(5)->get();
       
        return view('pages.msccs.dashboard', compact('totalCall', 'totalCustomer', 'monthlyData', 'recentActivity', 'sentiment'));
    }



    # logout function     
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }


}
