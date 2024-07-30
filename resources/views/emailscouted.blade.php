<!DOCTYPE html>
<html>
<head>
    <title>Athlete Scouted for Event Notification</title>
</head>
<body>
    <p>Hello {{ $athlete->name }},</p>

    <p>You have been scouted for an event in EScout. Event details are as per below: </p>

    <p><strong>Event Name:</strong> {{ $event->name }}</p>
    <p><strong>Venue:</strong> {{ $event->venue }}</p>
    <p><strong>Start Date:</strong> {{ $event->StartDate }}</p>
    <p><strong>End Date:</strong> {{ $event->EndDate }}</p>
    <p><strong>Message from Scout:</strong> {{ $event->message}}</p>

    <p>To stay updated on event details and manage your participation, please visit our website. You can accept or decline the event directly from there.</p>

    <p>Thank you!</p>
</body>
</html>
