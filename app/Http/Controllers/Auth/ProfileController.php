<?php

namespace App\Http\Controllers\Auth;

use App\Models\Level;
use App\Models\Skill;
use App\Models\Sport;
use App\Models\Athlete;
use Illuminate\Http\Request;
use App\Mail\AthleteApproved;
use App\Mail\AthleteRejected;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    //view athleteprofile blade
    public function index()
    {

        $level_id = Auth::guard('athlete')->user()->level_id;
        $level = Level::find($level_id);
        $sports = Auth::guard('athlete')->user() ? Auth::guard('athlete')->user()->sports : [];
        $skills = Auth::guard('athlete')->user() ? Auth::guard('athlete')->user()->skills : [];

        return view('athleteprofile', compact('level','sports', 'skills'));

    }

    //view editprofile blade
    public function editprofile(){
        return view('editprofile');
    }

    //view athleteprofile blade
    public function athleteprofile(){
        return view('athleteprofile');
    }

    //edit athlete account
    public function editathlete(){

        $level_id = Auth::guard('athlete')->user()->level_id;
        $level = Level::find($level_id);
        $levels = Level::all();
        $sports = Sport::all();
        $sportscurrent = Auth::guard('athlete')->user()->sports;
        $skillscurrent = Auth::guard('athlete')->user()->skills;

        return view('editathlete', compact('level','levels', 'sports', 'sportscurrent', 'skillscurrent'));
    }

    //update athlete profile
    public function updateprofile(Request $request, $id){

        Auth::guard('athlete')->user()->name = $request->name;
        Auth::guard('athlete')->user()->email = $request->email;
        Auth::guard('athlete')->user()->phone = $request->phone;

        Auth::guard('athlete')->user()->save();

        return back()->with('success', 'Profile successfully updated!');
    }

    //create athlete profile
    public function createathlete()
    {
        $athlete = Auth::guard('athlete')->user();

        // Check if the user has already requested to create an athlete profile and has been approved or is pending
        if ($athlete->status == 'Pending' || $athlete->status == 'Approved') {
            return redirect()->route('athleteprofile')->with('error', 'You already made your own athlete profile!');
        }

        // If the user has been rejected, allow them to create a new profile
        if ($athlete->status == 'Rejected') {
            // Clear previous sports associations and skills
            $athlete->sports()->detach();
            $athlete->skills()->delete();
        }

        $levels = Level::all();
        $sports = Sport::all();
        return view('createathlete', compact('levels', 'sports'));
    }


    //update athlete profile
    public function updateathlete(Request $request, $id)
    {
        $athlete = Auth::guard('athlete')->user();

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

        return redirect()->route('athleteprofile')->with('success', 'Profile updated successfully');
    }

    //store athlete profile
    public function storeathlete(Request $request)
    {
        $athlete = Auth::guard('athlete')->user();

        // Check if the user has already requested to create an athlete profile and has been approved or is pending
        if ($athlete->status == 'Pending' || $athlete->status == 'Approved') {
            return redirect()->route('athleteprofile')->with('error', 'You already made your own athlete profile!');
        }

        // Validate the input data
        $request->validate([
            'sports' => 'required|array',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'position' => 'required|string|max:255',
            'level' => 'required|integer|exists:levels,id',
            'achievement' => 'nullable|string',
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

        // Save the athlete's information
        $athlete->status = 'Pending';
        $athlete->save();

        // Attach selected sports
        $selectedSports = $request->input('sports');
        $athlete->sports()->sync($selectedSports);

        // Save the skills
        $validatedData = $request->only(['strength', 'speed', 'endurance', 'focus', 'reflex']);
        $validatedData['athlete_id'] = $athlete->id;
        Skill::updateOrCreate(['athlete_id' => $athlete->id], $validatedData);


        return redirect()->route('athleteprofile2', ['id' => $athlete->id])->with('success', 'Athlete profile successfully created!');
    }


    //view athlete profile request by admin
        public function viewrequest()
        {
            $athletes = Athlete::all();

            return view('viewrequest', [
                'athletes' => $athletes
            ]);
        }

        //accept athlete profile request
        public function acceptAthlete(Request $request, $id)
        {
            $athlete = Athlete::find($id);
            $athlete->status = 'Approved';
            $athlete->save();

            // Send email notification
            $details = [
                'title' => "EScout: Athlete profile approved!",
                'body' => "Congratulations! Your athlete profile has been approved. You can now view your profile in Escout!"
            ];

            Mail::to($athlete->email)->send(new AthleteApproved($details));

            return back()->with('success', 'Email sent successfully');
        }

        //reject athlete profile request
        public function rejectAthlete(Request $request, $id)
        {
            $athlete = Athlete::find($id);
            $athlete->status = 'Rejected';
            $athlete->remarks = $request->remarks; // Store remarks
            $athlete->save();

            $details = [
                'title' => "EScout: Important update on your athlete profile creation request.",
                'body' => "We regret to inform you that your athlete profile has been rejected.
                        Please review your profile and resubmit.
                        Reasons for rejection: " . $request->remarks . ".
                        Best regards,
                        EScout Team"
            ];


            Mail::to($athlete->email)->send(new AthleteRejected($details));

            return back()->with('success', 'Athlete rejected successfully!');
        }

        //view all athlete profile (list)
        public function viewAthletes(Request $request)
        {
            $query = Athlete::query();

            if ($request->has('level') && $request->level != '') {
                $query->where('level_id', $request->level);
            }

            if ($request->has('sport') && $request->sport != '') {
                $query->whereHas('sports', function ($q) use ($request) {
                    $q->where('sports.id', $request->sport);
                });
            }

            if ($request->has('min_weight') && $request->min_weight != '') {
                $query->where('weight', '>=', $request->min_weight);
            }

            if ($request->has('max_weight') && $request->max_weight != '') {
                $query->where('weight', '<=', $request->max_weight);
            }

            if ($request->has('min_height') && $request->min_height != '') {
                $query->where('height', '>=', $request->min_height);
            }

            if ($request->has('max_height') && $request->max_height != '') {
                $query->where('height', '<=', $request->max_height);
            }

            if ($request->has('min_skill') && $request->min_skill != '') {
                $query->where(function($q) use ($request) {
                    $q->where('skills->strength', '>=', $request->min_skill / 20)
                        ->orWhere('skills->speed', '>=', $request->min_skill / 20)
                        ->orWhere('skills->endurance', '>=', $request->min_skill / 20)
                        ->orWhere('skills->focus', '>=', $request->min_skill / 20)
                        ->orWhere('skills->reflex', '>=', $request->min_skill / 20);
                });
            }

            if ($request->has('max_skill') && $request->max_skill != '') {
                $query->where(function($q) use ($request) {
                    $q->where('skills->strength', '<=', $request->max_skill / 20)
                        ->orWhere('skills->speed', '<=', $request->max_skill / 20)
                        ->orWhere('skills->endurance', '<=', $request->max_skill / 20)
                        ->orWhere('skills->focus', '<=', $request->max_skill / 20)
                        ->orWhere('skills->reflex', '<=', $request->max_skill / 20);
                });
            }

            $athletes = $query->where('status', 'Approved')->get();

            $levels = Level::all();
            $sports = Sport::all();

            return view('listathletes', compact('athletes', 'levels', 'sports'));
        }

        //view athlete profile by admin
        public function athleteprofileAdmin($id)
        {
            $athlete = Athlete::find($id);
            $level_id = $athlete->level_id;
            $level = Level::find($level_id);
            $sports = $athlete->sports;
            $skills = $athlete->skills;

            return view('athleteprofile2', compact('athlete', 'level', 'sports', 'skills'));
        }

        //view athlete profile (demo) by admin
        public function athleteprofiledemo($id)
        {
            $athlete = Athlete::find($id);
            $level_id = $athlete->level_id;
            $level = Level::find($level_id);
            $sports = $athlete->sports;
            $skills = $athlete->skills;

            return view('demo', compact('athlete', 'level', 'sports', 'skills'));
        }

        //test send email
        public function sendEmail()
        {
            $details = [
                'title' => 'Mail from SeriNurul',
                'body' => 'This is a test email sent using Gmail SMTP.'
            ];

            Mail::to('hazimmarzuki88@gmail.com')->send(new AthleteApproved($details));

            return 'Email sent successfully';
        }

}
