<?php

namespace App\Http\Controllers\App;

use Auth;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    # Login page 
    public function index()
    {
        return view('pages.app.login');
    }



    # Login function
    public function login(Request $request)
    {

        # 1 : Check if user exists 
        $user = User::where('email', $request->email)->first();
        if($user)
        {

            # 2 : Check login credential - Redirect to modzy app dashboard
            if (Auth::attempt($request->only('email', 'password')))
                return redirect()->intended('/');   

        } 
        
        return back()->with('err', "Incorrect Username or Password")->withInput();
    }

}
 