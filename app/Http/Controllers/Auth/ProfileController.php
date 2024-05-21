<?php

namespace App\Http\Controllers\Auth;

use App\Models\Level;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Athlete;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {


        $level_id = Auth::guard('athlete')->user()->level_id;
        $level = Level::find($level_id);
        $sports = Auth::user()->sports;
        $skills = Auth::user()->skills;


        return view('athleteprofile', compact('level','sports', 'skills'));

    }

    public function editprofile(){
        return view('editprofile');
    }

    public function athleteprofile(){
        return view('athleteprofile');
    }

    public function editathlete(){

        $levels = Level::all();
        $sports = Sport::all();

        return view('editathlete', compact('levels', 'sports'));
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
            return redirect()->route('athleteprofile')->with('error', 'You already made your own athlete profile!');
        }
else{
        $levels = Level::all();
        $sports = Sport::all();
        return view('createathlete', compact('levels', 'sports'));
    }
    }

    public function updateathlete(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
        ]);

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;
        Auth::user()->weight = $request->weight;
        Auth::user()->height = $request->height;
        Auth::user()->position = $request->position;
        Auth::user()->level_id = $request->level;
        Auth::user()->image = $request->image;
        Auth::user()->achievement = $request->achievement;

        $request->validate([
            'sports' => 'required|array',
        ]);

        Auth::user()->save();

        return back()->with('success', 'Profile updated successfully');

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
        Auth::user()->image = $request->image;
        Auth::user()->status = 'pending';
        Auth::user()->achievement = $request->achievement;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/' . 'profile_image'), $imageName);
            Auth::user() ->image = 'img/' . 'profile_image/'. $imageName;
        }

        Auth::user()->save();


        $selectedSports = $request->input('sports');

        $validatedData = $request->validate([
            'strength' => 'required|integer|min:1|max:5',
            'speed' => 'required|integer|min:1|max:5',
            'endurance' => 'required|integer|min:1|max:5',
            'focus' => 'required|integer|min:1|max:5',
            'reflex' => 'required|integer|min:1|max:5',
        ]);

        $validatedData['athlete_id'] = Auth::id();

        Skill::create($validatedData);

        Auth::user()->sports()->attach($selectedSports);


        return redirect()->route('athleteprofile')->with('success', 'Athlete successfully created!');

    }
}
