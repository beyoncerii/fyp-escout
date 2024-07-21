<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Activity;
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
        $unavailableDates = collect($request->unavailable_dates);

        // Fetch all events and existing unavailable dates within the range of the unavailable dates
        $conflictingEvents = [];
        foreach ($unavailableDates as $unavailableDate) {
            $eventCount = Activity::where('athlete_id', $athleteId)
                ->where('status', 'accepted') // Check only accepted activities
                ->whereHas('event', function ($query) use ($unavailableDate) {
                    $query->whereDate('StartDate', '<=', $unavailableDate['date'])
                          ->whereDate('EndDate', '>=', $unavailableDate['date']);
                })
                ->count();

            $scheduleCount = Schedule::where('athlete_id', $athleteId)
                ->whereDate('date', $unavailableDate['date'])
                ->count();

            if ($eventCount > 0 || $scheduleCount > 0) {
                $conflictingEvents[] = $unavailableDate['date'];
            }
        }

        if (count($conflictingEvents) > 0) {
            return back()->withErrors([
                'unavailable_dates' => 'The following dates conflict with existing events or schedules: ' . implode(', ', $conflictingEvents),
            ])->withInput();
        }

        // Create the unavailable dates if there are no conflicts
        foreach ($unavailableDates as $unavailableDate) {
            Schedule::create([
                'date' => $unavailableDate['date'],
                'reason' => $unavailableDate['reason'],
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
