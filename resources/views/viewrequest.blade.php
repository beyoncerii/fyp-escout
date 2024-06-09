@extends('applayoutadmin')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-sm">

        <div style="margin-top: 50px">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col" style="text-align: center;">Athlete ID</th>
                    <th scope="col" style="text-align: center;">Athlete Name</th>
                    <th scope="col" style="text-align: center;">Request Date</th>
                    <th scope="col" style="text-align: center;">Profile Link</th>
                    <th scope="col" style="text-align: center;">Action</th>
                    <th scope="col" style="text-align: center;">Status</th>
                  </tr>
                </thead>

                <tbody>

                    @foreach ($athletes as $athlete)
    <tr>
        <td style="text-align: center;">{{ $athlete->id }}</td>
        <td style="text-align: center;">{{ $athlete->name }}</td>
        <td style="text-align: center;">{{ $athlete->created_at }}</td>
        <td style="text-align: center;"><a href="{{ route('athleteprofile') }}">Click Here</a></td>
        <td style="text-align: center;">
            <form action="{{ route('acceptathlete', $athlete->id) }}" method="POST">
                @csrf
                @method('GET')
                <button type="submit" class="btn btn-success">Accept</button>
            </form>
            <form action="{{ route('rejectathlete', $athlete->id) }}" method="GET">
                @csrf
                @method('GET')
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </td>
        <td style="text-align: center;">{{ $athlete->status}}</td>
    </tr>
@endforeach

                </tbody>
              </table>
        </div>

    </div>



@endsection
