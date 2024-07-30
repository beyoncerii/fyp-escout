@extends('applayout')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Availability</title>
    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
            <div class="d-flex align-items-center justify-content-center" style="margin-top: 5%;">
                <div class="box right-box p-6" style="background-color: white; width: 40%; max-height: 90vh; overflow-y: auto; padding: 2%;">
                    <div class="container">

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

                        <h2 style="text-align: center">Set Unavailable Dates</h2>
                        <h6 style="text-align: center; margin-bottom: 5%;">By keeping your availability up-to-date, you'll help us ensure that every scouting opportunity aligns with your schedule. This will not only save you time but also make the scouting process smoother and more effective.</h6>

                        <form id="availability-form" action="{{ route('schedule.store') }}" method="POST">
                            @csrf
                            <div id="availability-container">
                                <div class="form-group">
                                    <label for="unavailable_dates[0][date]">Unavailable Date:</label>
                                    <input type="date" name="unavailable_dates[0][date]" class="form-control" value="{{ old('unavailable_dates[0][date]') }}" required>
                                    <label for="unavailable_dates[0][reason]">Reason:</label>
                                    <input type="text" name="unavailable_dates[0][reason]" class="form-control" value="{{ old('unavailable_dates[0][reason]') }}" required>
                                </div>
                            </div>
                            <button type="button" id="add-more" class="btn btn-secondary">Add More</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <div class="form-text text-center text-dark mt-3">
                                View Athlete's schedule <a href="{{ url('viewschedule') }}" class="text-dark fw-bold">Athlete's Schedule</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    let count = 1;
                    $('#add-more').click(function() {
                        let newField = `
                        <div class="form-group">
                            <label for="unavailable_dates[${count}][date]">Unavailable Date:</label>
                            <input type="date" name="unavailable_dates[${count}][date]" class="form-control" required>
                            <label for="unavailable_dates[${count}][reason]">Reason:</label>
                            <input type="text" name="unavailable_dates[${count}][reason]" class="form-control" required>
                        </div>`;
                        $('#availability-container').append(newField);
                        count++;
                    });
                });
            </script>

</body>
</html>

@endsection
