@extends('applayout')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


@if (session('error'))
<p class="alert alert-danger">{{session('error')}}</p>
@endif

    <div class="row">
        <div class="col">
            <h3>{{ Auth::user()->name }}</h3>
        </div>
    </div>




        <div class="col-8">

            <div class="mb-3">
                <label for="name" class="form-label"><strong>Name: {{Auth::user()->name}}</strong></label>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label"><strong>Height: <br>
                </strong> {!! (Auth::user()->height) !!}</label>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label"><strong>Weight: </strong>{{ Auth::user()->weight}}</label>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label"><strong>Position: </strong>{{ Auth::user()->position}}</label>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label"><strong>Level: </strong>
                    {{$level->name}}</label>
            </div>
            <div class="mb-3">
                <label for="sports" class="form-label"><strong>Sports: </strong></label><br>
                <ul>

                @foreach ($sports as $sport)

                <li>{{ $sport->name }}</li>
                @endforeach
                  </ul>
            </div>


        </div>
    </div>

@endsection
