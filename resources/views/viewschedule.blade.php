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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Availability</title>
    <!-- Include FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center" style="margin-top: 5%; padding-bottom: 5%;">
        <div class="box right-box p-6" style="background-color: white; width: 80%; max-height: 90vh; overflow-y: auto; padding: 2%;">
            <div class="container mt-2">
                <h2 class="text-center">Athlete's Schedule</h2>
                <div id="calendar" style="height: 400px; max-width: 100%; margin: 0 auto;"></div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: @json($events),
                        eventColor: '#ff9f00', // Customize the color of the events
                    });
                    calendar.render();
                });
            </script>
        </div>
    </div>
</body>
</html>
@endsection
