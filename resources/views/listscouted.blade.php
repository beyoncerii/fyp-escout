@extends('applayoutcoach')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-sm">

        <div style="margin-top: 50px">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">Athlete ID</th>
                        <th scope="col" style="text-align: center;">Athlete Name</th>
                        <th scope="col" style="text-align: center;">Scouted Date</th>
                        <th scope="col" style="text-align: center;">Profile Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($athletes as $athlete)
                        <tr>
                            <td style="text-align: center;">{{ $athlete->id }}</td>
                            <td style="text-align: center;">{{ $athlete->name }}</td>
                            <td style="text-align: center;">{{ $athlete->scouts->first()->created_at }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('athleteprofile2', $athlete->id) }}">Click Here</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection
