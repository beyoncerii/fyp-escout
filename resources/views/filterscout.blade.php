@php
    if (auth('athlete')->check()) {
        $layout = 'applayout';
    } elseif (auth('staff')->check()) {
        $user = auth('staff')->user();
        if ($user && $user->role == 'admin') {
            $layout = 'applayoutadmin';
        } elseif ($user && $user->role == 'coach') {
            $layout = 'applayoutcoach';
        } else {
            $layout = 'applayout'; // Default layout if role is not admin or coach
        }
    } else {
        $layout = 'applayout'; // Default layout if neither athlete nor staff is authenticated
    }
@endphp

@extends($layout)

@section('content')

<title>Filter and Scout</title>

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">

    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

    <div class="row">
        <!-- Left Column: Event Details -->
        <div class="col-md-6">
            <div class="box p-4 d-flex flex-column" style="background-color: white; max-height: 90vh; overflow-y: auto;">

                <h3 class="mb-2" style="text-align: center;">Event Details</h3>

                <p style="margin-top: 5%"><strong>Event:</strong> {{ $event->name }}</p>
                <p><strong>Venue:</strong> {{ $event->venue }}</p>
                <p><strong>Capacity:</strong> {{ $event->capacity }}</p>
                <p><strong>Remaining Capacity:</strong> {{ $remainingCapacity }}</p>
                <p><strong>Start Date:</strong> {{ $event->StartDate }}</p>
                <p><strong>End Date:</strong> {{ $event->EndDate }}</p>
                <p><strong>Sport:</strong> {{ $event->sports ? $event->sports->name : 'No sport assigned' }}</p>
            </div>
        </div>

        <!-- Right Column: Athletes List -->
        <div class="col-md-6">
            <div class="box p-4 d-flex flex-column" style="background-color: white; max-height: 90vh; overflow-y: auto;">

                <div style="text-align: center;">
                    <h3 class="mb-2">Scout Athlete for Event</h3>
                    <small class="text-muted">The listed athletes are filtered based on their availability for the events and the sports they play, ensuring they match the event requirements.</small>
                </div>


                @if($isScouted)
                    <p style="margin-top: 5%;">Athletes successfully scouted for this event:</p>
                    <ul>
                        @foreach($scoutedAthletes as $athlete)
                            <li>{{ $athlete['name'] }} - {{ ucfirst($athlete['status']) }}</li>
                        @endforeach
                    </ul>
                @else
                    <h2 style="margin-top: 5%;">Available Athletes</h2>

                    @if($availableAthletes->isEmpty())
                        <p>No available athletes for this event.</p>
                    @else
                        <form action="{{ route('events.pickAthletes', $event->id) }}" method="POST">
                            @csrf
                            @foreach($availableAthletes as $athlete)
                                <div>
                                    <input type="checkbox" name="athletes[]" value="{{ $athlete->id }}">
                                    <a href="{{ route('demo', $athlete->id) }}">{{ $athlete->name }}</a>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3">Pick Athletes</button>
                        </form>
                    @endif
                @endif
            </div>
            <!-- Buttons aligned to the left -->
            <div class="text-right mt-3">
                <a href="{{ route('event.create') }}" class="btn btn-primary">Create Another Event</a>
                <a href="{{ route('viewevent') }}" class="btn btn-success ml-2">Back to Event Listing</a>
            </div>
        </div>
    </div>
</div>
@endsection


