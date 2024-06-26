<?php

namespace App\Http\Controllers;

use App\Models\Scout;
use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoutController extends Controller
{
    public function store(Request $request){
        $scout = new Scout();
        $scout->athlete_id = $request->athlete_id;
        $scout->coach_id = Auth::guard('staff')->user()->id ;
        $scout->save();
        return redirect()->back();
    }

    public function listScouted() {
        // Retrieve athletes who have been scouted
        $athletes = Athlete::whereHas('scouts')->get();

        return view('listscouted', [
            'athletes' => $athletes
        ]);
    }

}
