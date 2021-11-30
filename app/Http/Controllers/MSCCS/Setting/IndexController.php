<?php

namespace App\Http\Controllers\MSCCS\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    
    # Setting index page
    public function index(Request $request)
    {
        return view('pages.msccs.setting.index');
    }
    
    
    # API page
    public function api(Request $request)
    {
        return view('pages.msccs.setting.api');
    }



}
