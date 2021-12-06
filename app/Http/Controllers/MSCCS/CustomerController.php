<?php

namespace App\Http\Controllers\MSCCS;

use DB;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Keyword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    
    # Customer index page
    public function index(Request $request)
    {

        # 0 : Filter record		
        $customers = User::where('role_id', getConfig('role.customer'))->where('company_id', getCompany()->id);     
        $startDate = getFilterStartDate($request->startDate);
        $endDate = getFilterEndDate($request->endDate);        
        if($searchQuery = $request->input('query'))
            $records = $customers->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%$searchQuery%")
                ->orWhere('remark', 'like', "%$searchQuery%")
                ->orWhere('uid', 'like', "%$searchQuery%")
                ->orWhere('language', 'like', "%$searchQuery%")
                ->orWhere('country', 'like', "%$searchQuery%");                
            });
            
        # 1 : Get data         
        $customers = $customers->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate)->orderBy('created_at','DESC')->get();
        $tickets = Ticket::where('company_id', getCompany()->id)->get();

        return view('pages.msccs.customer.index', compact('customers','tickets'));
    }
    

    
    # Customer view page
    public function view($uid)
    {
        # Retrieve customer record - check & validate permission 
        $customer = User::whereUID($uid);
        if(!$customer && ($customer->company_id !=  getCompany()->id) && $customer->role_id != getConfig('role.customer')) abort(404);

        # Check if got call data
        if($customer->call->count() <= 0) return redirect('/customer')->with('err', 'No call data');

        # Get statistic data 
        $ticket = Ticket::where('customer_id', $customer->id);
        $totalCall = (clone $ticket)->count();

        # Get call vs date 
        $monthlyData = [];
        $monthlyRecord =  (clone $ticket)->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') new_date"), DB::raw('DAY(created_at) day'),DB::raw('count(*) as total'))->orderBy('new_date')->groupBy('day')->groupBy('new_date')->take(10)->get();            
        foreach($monthlyRecord as $record)        
            $monthlyData[] = ['label'=>$record->new_date, 'value' => $record->total ];

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
        $sentiment = calculateCompound($positive/$count, $neutral/$count , $negative/$count, true);  

        # Get Keyword chart
        $keywordData = [];
        $keywords = Keyword::where('company_id', getCompany()->id)->get();
        foreach($keywords as $keyword)
            $keywordData[] = ['label' => $keyword->value, 'value' => $keyword->ticket()->where('customer_id',$customer->id)->count()];

        return view('pages.msccs.customer.view', compact('customer', 'totalCall', 'monthlyData', 'sentiment', 'keywordData'));
    }



    # Create or update customer 
    public function updateOrCreate(Request $request){


        # Check if edit 
        $companyID =  getCompany()->id;
        if($request->uid)
        {
            # Check if record exists & check permission
            $record = User::whereUID($request->uid);   
            if(!$record && ($record->company_id != $companyID)) abort(404);
        }

        # Check if email existed
        if(User::where('email',$request->email)->exists() && (!$request->uid || ($request->uid && $request->email != $record->email)))
            return back()->with('err','Email existed');

        # Create or update 
        User::updateOrCreate(
            ['uid'=>$request->uid],
            $request->except(['editID', '_token']) + [
                'role_id' => getConfig('role.customer'),
                'company_id' => $companyID
            ]
        );

        return back()->with('success',  ($request->editID)?'Customer record updated' : 'Customer record created');
    }



    # Function to delete customer 
    public function delete(Request $request){

        # Retrieve customer record 
        $customer = User::whereUID($request->actionID);

        # Check record & permission
        if(!$customer && ($customer->company_id !=  getCompany()->id)) abort(404);

        # Delete record
        $customer->delete();
        return back()->with('success',  'Customer record deleted');

    }



    # Function to bind customer audio record
    public function bind(Request $request){

        # Retrieve customer record 
        $companyID = getCompany()->id;
        $customer = User::whereUID($request->uid);

        # Check record & permission
        if(!$customer && ($customer->company_id !=  $companyID)) abort(404);

        # Loop ticket and bind to customer 
        if($request->bind){
            foreach($request->bind as $uid){            
                $ticket = Ticket::where('uid', $uid)->where('company_id', $companyID)->first();
                $ticket->update(['customer_id' => $customer->id]);
            }
        }

        # Loop current record to remove unbind record
        $currentRecord = $customer->call->pluck('uid')->toArray();
        foreach($currentRecord as $uid){
            if(!in_array($uid, $request->bind))
            {
                $ticket = Ticket::where('uid', $uid)->where('company_id', $companyID)->first();
                $ticket->update(['customer_id' => null]);
            }
        }

        return back()->with('success',  'Customer record updated');

    }

}
