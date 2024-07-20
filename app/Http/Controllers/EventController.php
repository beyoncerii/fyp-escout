<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Athlete;
use App\Models\Activity;
use Illuminate\Http\Request;

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



    //Show the form of specic event
    public function view(Event $event)
    {
        $availableAthletes = $this->getAvailableAthletes($event->StartDate, $event->EndDate);

        return view('filterscout', ['event' => $event, 'availableAthletes' => $availableAthletes]);
    }
    // Get athletes that are available for the event
    private function getAvailableAthletes($startDate, $endDate)
    {
        return Athlete::where('status', 'Approved')
            ->whereDoesntHave('schedules', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
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
    $request->validate([
        'athletes' => 'required|array|max:' . $event->capacity,
        'athletes.*' => 'exists:athletes,id',
    ]);


    // Check if the number of picked athletes exceeds the event's capacity
    if (count($request->athletes) > $event->capacity) {
        return back()->withErrors([
            'athletes' => 'You cannot pick more athletes than the event capacity.',
        ])->withInput();
    }

    // Clear previous selections for the event
    Activity::where('event_id', $event->id)->delete();

    // Insert new selections
    foreach ($request->athletes as $athleteId) {
        Activity::create([
            'event_id' => $event->id,
            'athlete_id' => $athleteId,
            'status' => 'pending', // Adjust status as needed
        ]);
    }

    return back()->with('success', 'Athletes have been picked.');
}

}
