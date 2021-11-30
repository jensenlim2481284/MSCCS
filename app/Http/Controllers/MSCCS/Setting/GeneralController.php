<?php

namespace App\Http\Controllers\MSCCS\Setting;

use App\Models\Keyword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{

    
    # General setting page
    public function index(Request $request)
    {
        $company = getCompany();
        return view('pages.msccs.setting.general', compact('company'));
    }


    # Function to create keyword
    public function createKeyword(Request $request)
    {
        
        # Create keyword
        Keyword::create([
            'company_id' => getCompany()->id,
            'value' => $request->keyword
        ]);
    
        return back()->with('success', 'Keyword record created');

    }

    
    # Function to delete keyword
    public function deleteKeyword(Request $request)
    {
        # 1 - Retrieve keyword record & check if record exists
        $keyword = Keyword::find($request->actionID);
        if($keyword){

            # 2 - Check company have access to delete keyword
            if($keyword->company_id == getCompany()->id){
                $keyword->delete();
                return back()->with('success', 'Keyword record deleted');
            }

        }

        abort(404);
    }



}
