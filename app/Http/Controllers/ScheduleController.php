<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function create()
    {
        return view('calendar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unavailable_dates' => 'required|array',
            'unavailable_dates.*.date' => 'required|date',
            'unavailable_dates.*.reason' => 'required|string|max:255',
        ]);

        $athleteId = Auth::guard('athlete')->id();

        foreach ($request->unavailable_dates as $unavailable_date) {
            Schedule::create([
                'date' => $unavailable_date['date'],
                'reason' => $unavailable_date['reason'],
                'athlete_id' => $athleteId,
            ]);
        }

        return redirect()->route('calendar')->with('success', 'Unavailable dates added successfully');
    }

    public function show()
    {
        // Get the currently authenticated athlete's ID
        $athleteId = Auth::guard('athlete')->id();

        // Fetch only the unavailable dates for the authenticated athlete
        $events = Schedule::where('athlete_id', $athleteId)->get()->map(function($schedule) {
            return [
                'title' => $schedule->reason,
                'start' => $schedule->date,
                'end' => $schedule->date, // Adjust if you want a range
            ];
        });

        return view('viewschedule', ['events' => $events]);
    }

    public function showSchedule($id)
{

    $athleteId = $id;

    $athlete = Athlete::findOrFail($athleteId);
    $events = Schedule::where('athlete_id', $athleteId)->get()->map(function($schedule) {
        return [
            'title' => $schedule->reason,
            'start' => $schedule->date,
            'end' => $schedule->date, // Adjust if you want a range
        ];
    });

    return view('viewschedule', ['events' => $events]);
}







}
