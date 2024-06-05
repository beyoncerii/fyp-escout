<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('athlete')->attempt($request->only('email', 'password'))) {
            return redirect()->route('homeathlete');
        }
            elseif (Auth::guard('staff')->attempt($request->only('email', 'password'))) {
            $user = Auth::guard('staff')->user();
            if ($user->role === 'admin') {
                return redirect()->route('homeadmin');
            }
            elseif ($user->role === 'coach') {
                return redirect()->route('homecoach');
            } else {
                // Handle non-admin coach login
                return back()->with('error', 'Invalid username or password');
            }

        } else {
            return back()->with('error', 'Invalid username or password');
        }
    }
}
