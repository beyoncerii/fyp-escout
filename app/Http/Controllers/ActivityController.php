<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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


    // Accept an activity
    public function accept($activityId)
    {
        $activity = Activity::findOrFail($activityId);
        $activity->update(['status' => 'accepted']);
        return redirect()->route('activities.index')->with('success', 'Activity accepted.');
    }

    // Reject an activity
    public function reject($activityId)
    {
        $activity = Activity::findOrFail($activityId);
        $activity->update(['status' => 'rejected']);
        return redirect()->route('activities.index')->with('success', 'Activity rejected.');
    }
}
