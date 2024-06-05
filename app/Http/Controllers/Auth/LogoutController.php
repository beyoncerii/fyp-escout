<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    public function store()
    {
        if(Auth::guard('athlete') -> check())
        {
        Auth::guard('athlete') -> logout();
        return redirect()->route('home');
        }
        elseif(Auth::guard('staff') -> check()){
            Auth::guard('staff') -> logout();
            return redirect()->route('home');
        }
    }

}
