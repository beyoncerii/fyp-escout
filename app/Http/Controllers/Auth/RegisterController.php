<?php

namespace App\Http\Controllers\Auth;

use App\Models\Staff;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) {
        // Validate the common fields
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('athletes')->ignore($request->email, 'email'),
                Rule::unique('staff')->ignore($request->email, 'email'),
            ],
            'phone' => [
                'required',
                'max:255',
                Rule::unique('athletes')->ignore($request->phone, 'phone'),
                Rule::unique('staff')->ignore($request->phone, 'phone'),
            ],
            'password' => 'required|confirmed',
            'role' => 'required', // New field for role
        ]);

        $data['password'] = Hash::make($data['password']);

        // Save to the respective table based on the role
        if ($data['role'] === 'athlete') {
            Athlete::create($data);
            return redirect('/login');

        } else {
            Staff::create($data);
            //     'name' => $data['name'],
            //     'email' => $data['email'],
            //     'phone' => $data['phone'],
            //     'password' => $data['password'],
            //     'role' => $data['role'],
            // ]);

            return redirect('/login');

        //     if ($data['role'] === 'coach') {
        //         return redirect()->route('homecoach');
        //     } else if ($data['role'] === 'admin') {
        //         return redirect()->route('homeadmin');
        //     }
        // }

        //     if ($data['role'] === 'coach') {
        //         return redirect()->route('homecoach');
        //     } else if ($data['role'] === 'admin') {
        //         return redirect()->route('homecoach');
        //     }

    }
}

}
