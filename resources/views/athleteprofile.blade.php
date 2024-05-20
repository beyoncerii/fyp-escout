@extends('applayout')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


@if (session('error'))
<p class="alert alert-danger">{{session('error')}}</p>
@endif

    <div class="mb-2" style="margin-top: 10px; text-align: center; background-color: rgba(253, 253, 253, 0.808)">
            <h3>Player Name: {{ Auth::user()->name }}</h3>
    </div>

    <div class="container-sm" style=" margin-top: 20px; min-height: 50vh; background-color: rgba(253, 253, 253, 0.808); padding: 20px;}">
    <div>

        @if (Auth::user()->image)
        <img src="{{ asset(Auth::user()->image) }}" class="card-img-top" alt="Profile Image"
        style="width: 100%; height: 300px; object-fit: contain; margin-bottom: 20px">
        @endif

        <table class="table">
            <tbody>
                <tr>
                    <th scope="row"><strong>Name:</strong></th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th scope="row"><strong>Height:</strong></th>
                    <td>{{ Auth::user()->height }}cm</td>
                </tr>
                <tr>
                    <th scope="row"><strong>Weight:</strong></th>
                    <td>{{ Auth::user()->weight }}kg</td>
                </tr>
                <tr>
                    <th scope="row"><strong>Position:</strong></th>
                    <td>{{ Auth::user()->position }}</td>
                </tr>
                <tr>
                    <th scope="row"><strong>Level:</strong></th>
                    <td>{{ $level->name }}</td>
                </tr>
                <tr>
                    <th scope="row"><strong>Sports:</strong></th>
                    <td>
                        <ul>
                            @foreach ($sports as $sport)
                                <li>{{ $sport->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mb-1">
            <label for="sports" class="form-label"><strong>Skills:</strong></label>
        </div>

        <label for="strength" class="form-label">Strength</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skills->strength*20 }}%" aria-valuenow="{{$skills->strength*20 }}" aria-valuemin="0" aria-valuemax="100">{{$skills->strength*20}}%</div>
        </div>

        <label for="speed" class="form-label">Speed</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skills->strength*20 }}%" aria-valuenow="{{$skills->speed*20 }}" aria-valuemin="0" aria-valuemax="100">{{$skills->speed*20}}%</div>
        </div>

        <label for="endurance" class="form-label">Endurance</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skills->endurance*20 }}%" aria-valuenow="{{$skills->endurance*20 }}" aria-valuemin="0" aria-valuemax="100">{{$skills->endurance*20}}%</div>
        </div>

        <label for="focus" class="form-label">Focus</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skills->focus*20 }}%" aria-valuenow="{{$skills->focus*20 }}" aria-valuemin="0" aria-valuemax="100">{{$skills->focus*20}}%</div>
        </div>

        <label for="reflex" class="form-label">Reflex</label>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $skills->reflex*20 }}%" aria-valuenow="{{$skills->reflex*20 }}" aria-valuemin="0" aria-valuemax="100">{{$skills->reflex*20}}%</div>
        </div>

    </div>
</div>



@endsection
