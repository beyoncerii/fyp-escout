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

        $level_id = Auth::guard('athlete')->user()->level_id;
        $level = Level::find($level_id);
        $levels = Level::all();
        $sports = Sport::all();
        $sportscurrent = Auth::user()->sports;
        $skillscurrent = Auth::user()->skills;

        return view('editathlete', compact('level','levels', 'sports', 'sportscurrent', 'skillscurrent'));
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

    public function updateathlete(Request $request, $id)
    {
        $athlete = Auth::user();

        // Validate the input data
        $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'position' => 'required|string|max:255',
            'level' => 'required|integer|exists:levels,id',
            'achievement' => 'nullable|string',
            'sports' => 'required|array',
            'sports.*' => 'integer|exists:sports,id',
            'strength' => 'required|integer|min:1|max:5',
            'speed' => 'required|integer|min:1|max:5',
            'endurance' => 'required|integer|min:1|max:5',
            'focus' => 'required|integer|min:1|max:5',
            'reflex' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the authenticated user's profile
        $athlete->weight = $request->weight;
        $athlete->height = $request->height;
        $athlete->position = $request->position;
        $athlete->level_id = $request->level;
        $athlete->achievement = $request->achievement;

        // Handle the image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/profile_image'), $imageName);
            $athlete->image = 'img/profile_image/' . $imageName;
        }

        // Sync the sports
        $athlete->sports()->sync($request->sports);

        // Update the skills
        $validatedData = $request->only(['strength', 'speed', 'endurance', 'focus', 'reflex']);
        $validatedData['athlete_id'] = $athlete->id;

        // Update or create skills for the athlete
        $athlete->skills()->updateOrCreate(['athlete_id' => $athlete->id], $validatedData);

        // Save the updated athlete information
        $athlete->save();

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
