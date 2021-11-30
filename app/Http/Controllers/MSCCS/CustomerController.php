<?php

namespace App\Http\Controllers\MSCCS;

use App\Models\User;
use App\Models\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    
    # Customer index page
    public function index(Request $request)
    {
        $customers = User::where('role_id', getConfig('role.customer'))->get();
        $tickets = Ticket::all();
        return view('pages.msccs.customer.index', compact('customers','tickets'));
    }
    

    
    # Customer view page
    public function view($uid)
    {
        # Retrieve customer record - check & validate permission 
        $customer = User::whereUID($uid);
        if(!$customer && ($customer->company_id !=  getCompany()->id)) abort(404);

        return view('pages.msccs.customer.view', compact('customer'));
    }



    # Create or update customer 
    public function updateOrCreate(Request $request){


        # Check if edit 
        $companyID =  getCompany()->id;
        if($request->editID)
        {
            # Check if record exists & check permission
            $record = User::whereUID($request->editID);   
            if(!$record && ($record->company_id != $companyID)) abort(404);

        }

        # Create or update 
        User::updateOrCreate(
            ['uid'=>$request->editID],
            $request->except('editID') + [
                'role_id' => getConfig('role.customer'),
                'company_id' => $companyID
            ]
        );

        return back()->with('success',  ($request->editID)?'Customer record updated' : 'Customer record created');
    }



    # Customer action 
    public function action(Request $request){

        # Retrieve customer record 
        $customer = User::whereUID($request->actionID);

        # Check record & permission
        if(!$customer && ($customer->company_id !=  getCompany()->id)) abort(404);

        # Process based on action 
        $action = $request->action;
        switch($action){

            # Delete customer record
            case "delete" : 
                $customer->delete();
                return back()->with('success',  'Customer record deleted');

            # Bind audio record 
            case "bind" : 


                return back()->with('success',  'Customer record updated');
            

        }

        abort(404);

    }

}
