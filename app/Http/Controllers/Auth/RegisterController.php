<?php

namespace App\Http\Controllers\Auth;

use App\Models\Athlete;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) {
        //dd($request);

        $data =$request -> validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:athletes',
            'phone' => 'required|max:255|unique:athletes',
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        Athlete::create($data);

        return redirect('/login');

    }
}
