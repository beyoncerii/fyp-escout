<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Athlete;
use App\Models\Activity;
use App\Mail\AthleteScouted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{

    // Display a listing of the events created by the authenticated coach
    public function index()
    {

        $user = auth('staff')->user(); // Ensure the user is authenticated and is a coach

        if ($user && $user->role == 'coach') { // Retrieve events created by the authenticated coach

            $events = $user->events;
        } else {     // If the user is not a coach, you can either show an error message or an empty list

            $events = collect(); // An empty collection
        }

        return view('viewevent', compact('events'));
    }



    // Show the form for creating a new event
    public function create()
    {
        return view('createevent');
    }



    // Store a newly created event in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer',
            'StartDate' => 'nullable|date',
            'EndDate' => 'nullable|date|after_or_equal:StartDate',
        ]);

        $validated['staff_id'] = auth('staff')->id();     // Add the authenticated staff ID

        $event = Event::create($validated);     // Save the event

        // Return view with available athletes
        return redirect()->route('viewevent')->with('success', 'Event added successfully');
    }



    public function view(Event $event)
{
    // Get the number of accepted and pending athletes
    $athletesCount = Activity::where('event_id', $event->id)
        ->whereIn('status', ['accepted', 'pending'])
        ->count();

    // Calculate remaining capacity
    $remainingCapacity = $event->capacity - $athletesCount;

    // Check if the event is fully scouted
    $isScouted = $remainingCapacity <= 0;

    // Fetch available athletes excluding those who are accepted or rejected
    $availableAthletes = $this->getAvailableAthletes($event->StartDate, $event->EndDate, $event->id);

    // Fetch names of scouted athletes
    $scoutedAthletes = Activity::where('event_id', $event->id)
        ->whereIn('status', ['accepted', 'pending'])
        ->with('athlete') // Ensure the athlete relationship is loaded
        ->get()
        ->pluck('athlete.name')
        ->toArray();

    return view('filterscout', [
        'event' => $event,
        'availableAthletes' => $availableAthletes,
        'remainingCapacity' => $remainingCapacity,
        'isScouted' => $isScouted,
        'scoutedAthletes' => $scoutedAthletes
    ]);
}




// Get athletes that are available for the event excluding those who are rejected
private function getAvailableAthletes($startDate, $endDate, $eventId)
{
    return Athlete::where('status', 'Approved')
        ->whereDoesntHave('schedules', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        })
        ->whereDoesntHave('activities', function ($query) use ($eventId) {
            $query->where('event_id', $eventId)
                ->whereIn('status', ['accepted', 'rejected']); // Use 'whereIn' to exclude both statuses
        })
        ->get();
}





    // Show the form for editing the specified event
    public function edit($id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Return the edit view with the event data
        return view('editevent', compact('event'));
    }



    // Update the specified event in the database
    public function update(Request $request, $id)
    {
        $request->validate([ // Validate the request
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'venue' => 'required|string|max:255',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
        ]);

        $event = Event::findOrFail($id);     // Find the event by ID

        $event->update([     // Update the event with new data
            'name' => $request->input('name'),
            'capacity' => $request->input('capacity'),
            'venue' => $request->input('venue'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
        ]);

        // Redirect back with a success message
        return redirect()->route('viewevent')->with('success', 'Event updated successfully!');
    }



    public function pickAthletes(Request $request, Event $event)
{
    // Check if the number of athletes with status 'pending' or 'accepted' has reached the event's capacity
    $pickedAthletesCount = Activity::where('event_id', $event->id)
                                   ->whereIn('status', ['pending', 'accepted'])
                                   ->count();

    if ($pickedAthletesCount >= $event->capacity) {
        return back()->withErrors([
            'athletes' => 'You have already picked athletes for this event.',
        ])->withInput();
    }

    $request->validate([
        'athletes' => 'required|array|max:' . ($event->capacity - $pickedAthletesCount),
        'athletes.*' => 'exists:athletes,id',
    ]);

    $athleteIds = $request->athletes;

    // Update statuses of existing selections and add new ones
    foreach ($athleteIds as $athleteId) {
        Activity::updateOrCreate(
            [
                'event_id' => $event->id,
                'athlete_id' => $athleteId,
            ],
            [
                'status' => 'pending', // Adjust status as needed
            ]
        );
    }

    // Send email notifications to the picked athletes
    $athletes = \App\Models\Athlete::whereIn('id', $athleteIds)->get();
    foreach ($athletes as $athlete) {
        Mail::to($athlete->email)->send(new AthleteScouted($event));
    }

    return back()->with('success', 'Athletes have been picked and notified.');
}




}
