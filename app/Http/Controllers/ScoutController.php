<?php

namespace App\Http\Controllers;

use App\Models\Scout;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoutController extends Controller
{

    //store manually scouted athlete
    public function store(Request $request){
        $scout = new Scout();
        $scout->athlete_id = $request->athlete_id;
        $scout->coach_id = Auth::guard('staff')->user()->id ;
        $scout->save();
        return redirect()->back();
    }



    //show scouted athlete
    public function listScouted() {
        $coachId = Auth::guard('staff')->user()->id;

        // Retrieve athletes scouted by the authenticated coach
        $athletes = Athlete::whereHas('scouts', function ($query) use ($coachId) {
            $query->where('coach_id', $coachId);
        })->get();

        return view('listscouted', [
            'athletes' => $athletes
        ]);
    }


}
