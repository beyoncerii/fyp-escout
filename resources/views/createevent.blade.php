@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/test.css') }}" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="d-flex align-items-center justify-content-center" style="margin-top: 3%;">
    <div class="box right-box p-4" style="background-color: rgba(227, 237, 247, 0.548); width: 60%; max-height: 90vh; overflow-y: auto;">
        <header class="mb-4" style="text-align: center">Create Event</header>

        <form>
            @csrf
            <div class="row">
                <!-- Left section: Event details -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="event-name"><strong>Event Name</strong></label>
                        <input type="text" class="form-control" id="event-name" name="name" placeholder="Event Name" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity"><strong>Capacity</strong></label>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity" required>
                    </div>

                    <div class="form-group">
                        <label for="venue"><strong>Venue</strong></label>
                        <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" required>
                    </div>

                    <div class="form-group">
                        <label for="event-date"><strong>Date</strong></label>
                        <input type="date" class="form-control" id="event-date" name="date" required>
                    </div>
                </div>

                <!-- Right section: Search and select athletes -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="athlete-search"><strong>Search Athletes</strong></label>
                        <input type="text" class="form-control mb-2" id="athlete-search" placeholder="Search Athletes...">
                    </div>

                    <div class="form-group">
                        <label for="athletes-list"><strong>Select Athletes</strong></label>
                        <select name="athletes[]" id="athletes-list" class="form-control" multiple>
                            <!-- Filtered athletes will be appended here -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Create Event</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const athleteSearch = document.getElementById('athlete-search');
        const athletesList = document.getElementById('athletes-list');

        athleteSearch.addEventListener('input', function() {
            // TODO: Implement search functionality to filter and append athletes to athletesList
        });
    });
</script>

@endsection
