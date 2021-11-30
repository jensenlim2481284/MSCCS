<?php

namespace App\Http\Controllers\MSCCS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{


    # Dashboard page 
    public function index()
    {
          return view('pages.msccs.dashboard');
    }



    # logout function     
    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }


}
