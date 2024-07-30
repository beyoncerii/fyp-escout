@extends('applayoutcoach')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-sm">

        <div style="margin-top: 50px">

            <h3 class="text-center bg-white p-3 rounded">List of Scouted Athletes</h3>


            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
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
                                <a href="{{ route('demo', $athlete->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View Profile
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
