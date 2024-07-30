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

<div class="container">

    <h3 class="text-center bg-white p-3 rounded" style="margin-bottom: 2%; margin-top: 3%;">List of Athlete's Upcoming Events</h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">Event Name</th>
                <th scope="col" style="text-align: center;">Start Date</th>
                <th scope="col" style="text-align: center;">End Date</th>
                <th scope="col" style="text-align: center;">Event Venue</th>
                <th scope="col" style="text-align: center;">Status</th>
                <th scope="col" style="text-align: center;">Approve</th>
                <th scope="col" style="text-align: center">Reject</th>
            </tr>
        </thead>

        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->event->name }}</td>
                    <td>{{ $activity->event->StartDate }}</td>
                    <td>{{ $activity->event->EndDate }}</td>
                    <td>{{ $activity->event->venue}}</td>

                    <td>
                        @if($activity->status == 'accepted')
                            Accepted
                        @elseif($activity->status == 'rejected')
                            Rejected
                        @else
                            Pending
                        @endif
                    </td>

                    <td>
                        @if($activity->status == 'pending')

                        <form action="{{ route('activities.accept', $activity->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>

                        @endif
                    <td>

                        @if($activity->status == 'pending')

                        <form action="{{ route('activities.reject', $activity->id) }}" method="POST" style="display:inline;">
                            @csrf

                            <div class="input-group">
                                <input type="text" name="reason" class="form-control form-control-sm" placeholder="Enter reason for rejection" required>
                                <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                        @endif

                    </td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
