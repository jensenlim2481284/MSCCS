<?php

namespace App\Http\Controllers\MSCCS;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{


    # Profile page 
    public function index()
    {
        return view('pages.msccs.profile');
    }


}
