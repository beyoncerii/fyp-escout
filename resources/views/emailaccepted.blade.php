<!DOCTYPE html>
<html>
<head>
    <title>Athlete Accept Event Notification</title>
</head>
<body>
    <h1>Athlete Accepted Your Event</h1>
    <p>Dear {{ $event->staff->name }},</p>
    <p>We are pleased to inform you that the athlete {{ $athlete->name }} has accepted the event "{{ $event->name }}".</p>
    <p>Event Details:</p>
    <ul>
        <li>Name: {{ $event->name }}</li>
        <li>Venue: {{ $event->venue }}</li>
        <li>Start Date: {{ $event->StartDate }}</li>
        <li>End Date: {{ $event->EndDate }}</li>
    </ul>
    <p>Thank you for using our service.</p>
</body>
</html>
