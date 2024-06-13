@extends('applayout')

@section('content')

    <div class="container" style="margin-top: 50px;"> <!-- Add margin top to create gap from header -->
        <div class="row"> <!-- Remove justify-content-center class -->

            @foreach ($athletes as $athlete)

                @if ($athlete->status == 'Approved') <!-- Check if athlete status is approved -->

                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30"> <!-- Use Bootstrap's grid classes to create a responsive layout -->
                        <div class="card" style="height: 400px; overflow: hidden;"> <!-- Add overflow: hidden to prevent scrolling -->

                            @if ($athlete->image)
                                <img src="{{ asset($athlete->image) }}" class="card-img-top" alt="Athlete Image"
                                style="width: 100%; height: 200px; object-fit: contain;">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center"><strong>{{ $athlete->name }}</strong></h5>
                                <p class="card-text"><strong>Height:</strong> {{ $athlete->height }}</p>
                                <p class="card-text"><strong>Weight:</strong> {{ $athlete->weight }}</p>

                                <strong>Player's Level:</strong>
                                <div class="countdown-container d-inline">
                                    <span id="level-{{ $athlete->id }}">{{ $athlete->level->name }}</span>
                                </div> <br>

                                <div class="text-center">
                                    <a type="submit"
                                    class="btn btn-primary btn-sm"
                                    style="margin-top: 10px; margin-right: 10px; margin-bottom: 10px;"
                                    href="{{ route('athleteprofile', $athlete->id) }}"
                                    >View</a>
                                </div>

                            </div>
                        </div>
                    </div>

                @endif <!-- End of if statement -->

            @endforeach

        </div>
    </div>

@endsection
