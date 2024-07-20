<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        // Get the currently authenticated athlete's ID
        $athleteId = Auth::guard('athlete')->id();

        // Fetch activities related to the authenticated athlete
        $activities = Activity::where('athlete_id', $athleteId)
            ->with('event') // Ensure the event relationship is loaded
            ->get();

        return view('viewactivities', ['activities' => $activities]);
    }

    public function accept($id)
{
    // Find the activity by ID
    $activity = Activity::findOrFail($id);

    // Check if the activity belongs to the currently authenticated athlete
    if ($activity->athlete_id !== Auth::guard('athlete')->id()) {
        return redirect()->route('activities.index')->with('error', 'Unauthorized action.');
    }

    // Update the activity status to accepted
    $activity->status = 'accepted';
    $activity->save();

    // Fetch the event related to the activity
    $event = $activity->event;

    // Generate all dates between the event's start and end dates
    $startDate = new \DateTime($event->StartDate);
    $endDate = new \DateTime($event->EndDate);
    $dateInterval = new \DateInterval('P1D'); // 1 day interval
    $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('+1 day'));

    // Create a new schedule entry for each date in the event
    foreach ($datePeriod as $date) {
        Schedule::create([
            'date' => $date->format('Y-m-d'),
            'reason' => $event->name,
            'athlete_id' => $activity->athlete_id,
        ]);
    }

    return redirect()->route('activities.index')->with('success', 'Activity accepted and schedule updated successfully.');
}



public function reject($id)
{
    // Find the activity by ID
    $activity = Activity::findOrFail($id);

    // Check if the activity belongs to the currently authenticated athlete
    if ($activity->athlete_id !== Auth::guard('athlete')->id()) {
        return redirect()->route('activities.index')->with('error', 'Unauthorized action.');
    }

    // Update the activity status to rejected
    $activity->status = 'rejected';
    $activity->save();

    return redirect()->route('activities.index')->with('success', 'Activity rejected successfully.');
}

}
