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

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .main-body {
            margin-top: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .card-body {
            flex: 1; /* Ensures the card body expands to fill available space */
        }

        .card-profile-details {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        @media (max-width: 992px) {
            .card {
                flex-direction: column;
            }
        }
    </style>

    <div class="container">
        <div class="main-body">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body card-profile-details">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset($athlete->image) }}" alt="Admin" class="rounded-circle p-1 bg-dark" width="110">
                                <div class="mt-3">
                                    <h4>{{$athlete->name}}</h4>
                                    <p class="text-secondary mb-1">UiTM Cawangan Melaka</p>
                                    <p class="text-muted font-size-sm">Kampus Jasin</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Full Name: </h6>
                                    <span class="text-secondary">{{$athlete->name}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Phone Number:</h6>
                                    <span class="text-secondary">0{{$athlete->phone}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Email:</h6>
                                    <span class="text-secondary">{{$athlete->email}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Weight:</h6>
                                    <span class="text-secondary">{{$athlete->weight}}kg</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Height:</h6>
                                    <span class="text-secondary">{{$athlete->height}}cm</span>
                                </li>

                                @auth('staff')
                                    @if (auth('staff')->user()->role == 'admin')
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Status:</h6>
                                            <span class="text-secondary">{{ $athlete->status }}</span>
                                            <form action="{{ route('delete-athlete', ['id' => $athlete->id]) }}" method="POST" onsubmit="return confirmDelete();">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Contact:</h6>
                                            <span class="text-secondary">
                                                <a href="https://api.whatsapp.com/send?phone=60{{ $athlete->phone }}&text=Hello%20{{ $athlete->name }},%20I%20am%20from%20admin%20team%20and%20would%20like%20to%20contact%20you." target="_blank" class="btn btn-success">
                                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                                </a>
                                            </span>
                                        </li>
                                    @endif
                                @endauth

                                <script>
                                    function confirmDelete() {
                                        return confirm('Are you sure you want to delete this athlete?');
                                    }
                                </script>

                                @auth('athlete')
                                    @if (auth('athlete')->user()->id == $athlete->id)
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">Your Status:</h6>
                                            <span class="text-secondary">{{ $athlete->status }}</span>
                                        </li>

                                        <div class="d-flex justify-content-center mt-3">
                                            @if ($athlete->status == 'Rejected')
                                                <a href="{{ route('test') }}" class="btn btn-danger">Recreate Athlete Profile</a>
                                            @else
                                                <a href="{{ route('editathlete') }}" class="btn btn-success">Edit Profile</a>
                                            @endif
                                        </div>
                                    @endif
                                @endauth

                                @auth('staff')
                                    @if (auth('staff')->user() && auth('staff')->user()->role == 'coach')
                                        <div class="d-flex justify-content-center mt-3">
                                            <a href="https://api.whatsapp.com/send?phone=60{{ $athlete->phone }}&text=You're scouted!" class="btn btn-success" style="margin-top: 10px;" onclick="return confirmScout();">
                                                <i class="fab fa-whatsapp"></i> Scout Athlete
                                            </a>
                                        </div>

                                        <form action="{{ route('coach-scout') }}" method="POST">
                                            @csrf
                                            <h5 style="margin-top: 10px">Did you scout?</h5>
                                            Let us know, and we’ll help you track your action.

                                            <input type="hidden" name="athlete_id" value="{{ $athlete->id }}">

                                            @php
                                                // Check if the athlete has been scouted by the authenticated coach
                                                $scouted = $athlete->scouts()->where('coach_id', Auth::guard('staff')->user()->id)->exists();
                                            @endphp

                                            @unless($scouted)
                                                <button type="submit" class="btn btn-success" style="margin-top: 10px;" onclick="return confirmScout();">
                                                    Yes, I scouted
                                                </button>
                                            @else
                                                <span class="text-muted">You have already scouted this athlete.</span>
                                            @endunless
                                        </form>

                                        <script>
                                            function confirmScout() {
                                                return confirm('Are you sure you want to scout this athlete?');
                                            }
                                        </script>
                                    @endif
                                @endauth

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center mb-3">{{$athlete->name}}'s Information</h5>

                            <div class="row mb-1 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Sports:</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="border p-2 rounded">
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($sports as $sport)
                                                <li>{{ $sport->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Position:</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="border p-2 rounded">
                                        {!! nl2br(e($athlete->position)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Level:</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="border p-2 rounded">
                                        <label class="form-control-plaintext mb-0">{{ $level->name }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Achievement:</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="border p-2 rounded">
                                        {!! nl2br(e($athlete->achievement)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address:</h6>
                                </div>
                                <div class="col-sm-9">
                                    <div class="border p-2 rounded">
                                        <label class="form-control-plaintext mb-0">UiTM Kampus Jasin, Jalan Lembah Kesang 1/1-2, Kampung Seri Mendapat, 77300 Merlimau, Melaka</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-center mb-3">{{$athlete->name}}'s Skills Stats</h5>

                                    <p>Strength</p>
                                    <div class="progress mb-3" style="height: 15px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $skills->strength * 20 }}%" aria-valuenow="{{ $skills->strength * 20 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $skills->strength * 20 }}%
                                        </div>
                                    </div>

                                    <p>Speed</p>
                                    <div class="progress mb-3" style="height: 15px">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $skills->speed * 20 }}%" aria-valuenow="{{ $skills->speed * 20 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $skills->speed * 20 }}%
                                        </div>
                                    </div>

                                    <p>Endurance</p>
                                    <div class="progress mb-3" style="height: 15px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $skills->endurance * 20 }}%" aria-valuenow="{{ $skills->endurance * 20 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $skills->endurance * 20 }}%
                                        </div>
                                    </div>

                                    <p>Focus</p>
                                    <div class="progress mb-3" style="height: 15px">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $skills->focus * 20 }}%" aria-valuenow="{{ $skills->focus * 20 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $skills->focus * 20 }}%
                                        </div>
                                    </div>

                                    <p>Reflex</p>
                                    <div class="progress mb-3" style="height: 15px">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $skills->reflex * 20 }}%" aria-valuenow="{{ $skills->reflex * 20 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $skills->reflex * 20 }}%
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/667a45929d7f358570d308e7/1i16pvhd9';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

@endsection
