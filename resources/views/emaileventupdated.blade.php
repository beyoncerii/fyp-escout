<!DOCTYPE html>
<html>
<head>
    <title>Event Update Notification</title>
</head>
<body>
    <h1>Notification on Event Update</h1>

    <p>Dear Athlete,</p>

    <p>We are writing to inform you that the event <strong>{{ $event->name }}</strong> has been updated.</p>

    <p>New Venue: {{ $event->venue }}</p>

    <p>Please visit EScout website for more information. Thank you.</p>
</body>
</html>
