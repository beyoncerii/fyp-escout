<?php

namespace App\Http\Controllers\Auth;

use App\Models\Level;
use App\Models\Athlete;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // public function index()
    // {
    //     $user_id = Auth::guard('athlete')->user()->id;
    //     $level = Level::find($level_id);
    //     $level_id = Auth::guard('athlete')->user()->level_id;
    //     return view('athleteprofile', compact('level'));
    // }

    public function index()
    {
        $user_id = Auth::guard('athlete')->user()->id;
        $athlete = Athlete::find($user_id);
        $level = $athlete->level; // Assuming the user has only one level, if there are multiple levels, you may need to adjust this part accordingly
        return view('athleteprofile', compact('level'));
    }

    public function editprofile(){
        return view('editprofile');
    }

    public function athleteprofile(){
        return view('athleteprofile');
    }


    public function updateprofile(Request $request, $id){

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;

        Auth::user()->save();

        return back()->with('success', 'Profile successfully updated!');
    }

    public function createathlete(){

        $levels = Level::all();
        return view('createathlete', compact('levels'));
    }

    public function storeathlete( Request $request){

        Auth::user()->weight = $request->weight;
        Auth::user()->height = $request->height;
        Auth::user()->position = $request->position;


        Auth::user()->level_id = $request->level;

        Auth::user()->save();

        return redirect()->route('homeathlete')->with('success', 'Athlete successfully created!');

    }
}
