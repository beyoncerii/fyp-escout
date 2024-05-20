<?php

namespace App\Http\Controllers\Auth;

use App\Models\Level;
use App\Models\Sport;
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
        // $user_id = Auth::guard('athlete')->user()->id;
        // $athlete = Athlete::find($user_id);

        $level_id = Auth::guard('athlete')->user()->level_id;
        $level = Level::find($level_id);

        $sports = Auth::user()->sports;
        // $sport_id = Auth::guard('athlete')->user()->sport_id;
        // $sport = Sport::find($sport_id);

        return view('athleteprofile', compact('level','sports'));
        // $level = $athlete->level; // Assuming the user has only one level, if there are multiple levels, you may need to adjust this part accordingly
        // return view('athleteprofile', compact('level'));
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

        if(Auth::user()->status == 'pending' || Auth::user()->status == 'approved'){
            return redirect()->route('athleteprofile')->with('error', 'You have request to created an athlete profile!');
        }
else{
        $levels = Level::all();
        $sports = Sport::all();
        return view('createathlete', compact('levels', 'sports'));
    }
    }

    public function storeathlete( Request $request){

        $request->validate([
            'sports' => 'required|array',
        ]);

        Auth::user()->weight = $request->weight;
        Auth::user()->height = $request->height;
        Auth::user()->position = $request->position;
        Auth::user()->level_id = $request->level;
        Auth::user()->level_id = $request->level;
        Auth::user()->status = 'pending';

        Auth::user()->save();


        $selectedSports = $request->input('sports');

        // Attach the selected sports to the athlete
        Auth::user()->sports()->attach($selectedSports);

        return redirect()->route('athleteprofile')->with('success', 'Athlete successfully created!');

    }
}
