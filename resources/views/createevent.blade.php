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

<title>Create Event</title>

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="d-flex align-items-center justify-content-center" style="margin-top: 3%; padding-bottom: 3%;">
    <div class="box right-box p-4" style="background-color: rgba(227, 237, 247, 0.548); width: 40%; max-height: 90vh; overflow-y: auto; ">

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

        <header class="mb-2" style="text-align: center;">Create Event</header>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="container">
                <div class="form-group">
                    <label for="event-name"><strong>Event Name</strong></label>
                    <input type="text" class="form-control" id="event-name" name="name" placeholder="Event Name">
                </div>

                <div class="form-group">
                    <label for="capacity"><strong>Capacity</strong></label>
                    <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity">
                </div>

                <div class="form-group">
                    <label for="venue"><strong>Venue</strong></label>
                    <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue">
                </div>

                <div class="form-group">
                    <label for="sports"><strong>Sport</strong></label><br>
                            @foreach ($sports as $sport)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sport_id" id="sport-{{ $sport->id }}" value="{{ $sport->id }}">
                                    <label class="form-check-label" for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                                </div>
                            @endforeach
                </div>



                <div class="form-group">
                    <label for="StartDate"><strong>Start Date</strong></label>
                    <input type="date" class="form-control" id="StartDate" name="StartDate">
                </div>

                <div class="form-group">
                    <label for="EndDate"><strong>End Date</strong></label>
                    <input type="date" class="form-control" id="EndDate" name="EndDate">
                </div>

                <div class="form-group">
                    <label for="message"><strong>Message</strong></label>
                    <textarea name="message" id="message" name="message" placeholder="Open this link to join my WhatsApp Group: https://chat.whatsapp.com/F3Jtmpj1gjsE5n2ovtzSHX " class="form-control">{{ old('message', $event->message ?? '') }}</textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="submit" class="btn btn-success">Create Event</button>
                <a href="{{ route('viewevent') }}" class="btn btn-primary">
                    <i class="fas fa-list"></i> View Events
                </a>
            </div>


        </form>
    </div>
</div>

@endsection
