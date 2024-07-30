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

<title>View Event</title>

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-sm" style="padding-bottom: 3%">
    <div style="margin-top: 50px">

        @if (session('success'))
    <div class="alert alert-success" style="margin-top: 2%">
        {{ session('success') }}
    </div>
@endif

        <h3 class="text-center bg-white p-3 rounded">List of Events</h3>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" style="text-align: center;">Event ID</th>
                    <th scope="col" style="text-align: center;">Event Name</th>
                    <th scope="col" style="text-align: center;">Capacity</th>
                    <th scope="col" style="text-align: center;">Venue</th>
                    <th scope="col" style="text-align: center;">Start Date</th>
                    <th scope="col" style="text-align: center;">End Date</th>
                    <th scope="col" style="text-align: center;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td style="text-align: center;">{{ $event->id }}</td>
                    <td style="text-align: center;">{{ $event->name }}</td>
                    <td style="text-align: center;">{{ $event->capacity }}</td>
                    <td style="text-align: center;">{{ $event->venue }}</td>
                    <td style="text-align: center;">{{ $event->StartDate }}</td>
                    <td style="text-align: center;">{{ $event->EndDate }}</td>

                    <td style="text-align: center;">

                        <a href="{{ route('events.view', $event->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href=" {{ route('events.edit', $event->id) }} " class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('event.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Create Event
            </a>
        </div>

    </div>
</div>

@endsection
