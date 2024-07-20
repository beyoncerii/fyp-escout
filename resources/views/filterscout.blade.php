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

<div class="d-flex align-items-center justify-content-center" style="margin-top: 3%; padding-bottom: 3%;">
    <div class="box right-box p-4" style="background-color: white; width: 40%; max-height: 90vh; overflow-y: auto; ">

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

        <header class="mb-2" style="text-align: center;">Filter and Scout</header>

        <p>Event: {{ $event->name }}</p>
        <p>Venue: {{ $event->venue }}</p>
        <p>Capacity: {{ $event->capacity }}</p>
        <p>Start Date: {{ $event->StartDate }}</p>
        <p>End Date: {{ $event->EndDate}}</p>

        <h2>Available Athletes</h2>

        <form action="{{ route('events.pickAthletes', $event->id) }}" method="POST">
            @csrf
            @foreach($availableAthletes as $athlete)
                <div>
                    <input type="checkbox" name="athletes[]" value="{{ $athlete->id }}">
                    <label>{{ $athlete->name }}</label>
                </div>
            @endforeach
            <button type="submit">Pick Athletes</button>
        </form>

        {{-- @if($availableAthletes->isEmpty())
            <p>No athletes are available for this event.</p>
        @else
            <ul>
                @foreach($availableAthletes as $athlete)
                    <li>{{ $athlete->name }} - {{ $athlete->email }}</li>
                @endforeach
            </ul>
        @endif --}}

        <a href="{{ route('createevent') }}">Create Another Event</a>

    </div>
</div>


@endsection
