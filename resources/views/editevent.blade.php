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

<title>Edit Event</title>

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="d-flex align-items-center justify-content-center" style="margin-top: 3%; padding-bottom: 3%;">
    <div class="box right-box p-4" style="background-color: white; width: 40%; max-height: 90vh; overflow-y: auto;">

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

        <header class="mb-2" style="text-align: center;">Edit Event</header>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="form-group">
                    <label for="event-name"><strong>Event Name</strong></label>
                    <input type="text" class="form-control" id="event-name" name="name" value="{{ old('name', $event->name) }}" placeholder="Event Name">
                </div>

                <div class="form-group">
                    <label for="venue"><strong>Venue</strong></label>
                    <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $event->venue) }}" placeholder="Venue">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="capacity"><strong>Capacity</strong></label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $event->capacity) }}" placeholder="Capacity">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sports"><strong>Sport</strong></label>
                        <select class="form-control" id="sports" name="sport_id" {{ $hasPendingOrAcceptedAthletes ? 'disabled' : '' }}>
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}" {{ old('sport_id', $event->sport_id) == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Sports of the event cannot be changed if any athletes have been scouted to avoid event clashing with the athlete's current schedule.</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="StartDate"><strong>Start Date</strong></label>
                        <input type="date" class="form-control" id="StartDate" name="StartDate" value="{{ old('StartDate', $event->StartDate) }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="EndDate"><strong>End Date</strong></label>
                        <input type="date" class="form-control" id="EndDate" name="EndDate" value="{{ old('EndDate', $event->EndDate) }}">
                    </div>

                    <small class="text-muted" style="margin-bottom: 10px;">Date of the event cannot be changed if any athletes have been scouted to avoid event clashing with the athlete's current schedule.</small>

                </div>

                <div class="form-group">
                    <label for="message"><strong>Message</strong></label>
                    <textarea name="message" id="message" placeholder="Enter your message here" class="form-control">{{ old('message', $event->message) }}</textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="submit" class="btn btn-success">Update Event</button>
                <a href="{{ route('viewevent') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i> Back to Event Listing
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
