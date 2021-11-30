<?php

namespace App\Http\Controllers\MSCCS\Setting;

use App\Models\User;
use App\Models\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmbedController extends Controller
{

    
    # Embed page
    public function index(Request $request)
    {
        $company = getCompany();
        return view('pages.msccs.setting.embed', compact('company'));
    }

    
    # Function to update whitelist domain
    public function updateWhitelist(Request $request)
    {
        $company = getCompany();
        $company->update($request->only('domain'));
        return back()->with('success', 'Domain whitelist updated');

    }


    # Function to display embed function
    public function displayEmbed($type, Request $request){

        # Validate company record & user record
        $company = Company::where('uid', simpleDecryption($request->token))->first();
        $user = User::where('uid', simpleDecryption($request->access))->first();
        if($company && ($company->id == $user->company_id)){

            # Check domain whitelist 
            if (strpos(request()->headers->get('referer'), $company->domain) !== false)
            {

                # Display embed based on type 
                switch($type){

                    # Smart recording feature
                    case "recording" : 
                        return view('pages.msccs.embed.record', compact('company', 'user'));

                }
            }
        }

        abort(404);

    }



}
