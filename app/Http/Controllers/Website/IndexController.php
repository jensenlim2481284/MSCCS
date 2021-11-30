<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    # Landing page 
    public function index()
    {
        return view('pages.website.index');
    }

}
 