<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    # Index page 
    public function index()
    {
        return view('pages.app.index');
    }


    # App page 
    public function app()
    {
        return view('pages.app.apps');
    }

}
 