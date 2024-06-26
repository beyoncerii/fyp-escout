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

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    @if (session('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif

        <div class="mb-2" style="margin-top: 10px; text-align: center; background-color: rgba(253, 253, 253, 0.808">
            <h3>Player Name: {{ $athlete->name }}</h3>
        </div>

        <div class="container" style="margin-top: 20px; min-height: 50vh; background-color: rgba(253, 253, 253, 0.808); padding: 20px;">
        <div class="row">

            <!-- Image Section -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                @if ($athlete->image)
                    <img src="{{ asset($athlete->image) }}" class="img-responsive" style="width: 100%; height: 300px; object-fit: contain; margin-bottom: 20px" width="304" height="236">
                @endif
            </div>

                <!-- Athlete Details Section -->
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    @auth('staff')
                        @if (auth('staff')->user()->role == 'admin')
                            <div class="mb-3">
                                <div style="float: right; margin-top: 5px;">
                                    <span style="font-weight: bold;">Status: </span>
                                    <span>{{ $athlete->status }}</span>
                                </div>
                            </div>
                        @endif
                    @endauth

                    @auth('athlete')
                        @if (auth('athlete')->user()->id == $athlete->id)
                            <div class="mb-3">
                                <div style="float: right; margin-top: 5px;">
                                    <span style="font-weight: bold;">Your Status: </span>
                                    <span>{{ $athlete->status }}</span>
                                </div>
                            </div>
                        @endif
                    @endauth

                    <div class="container-sm">
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name: </strong>{{ $athlete->name }}</label>
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label"><strong>Weight: </strong> {{ $athlete->weight }}kg</label>
                        </div>

                        <div class="mb-3">
                            <label for="height" class="form-label"><strong>Height: </strong> {{ $athlete->height }}cm</label>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label"><strong>Position: </strong> {{ $athlete->position }}</label>
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label"><strong>Level: </strong> {{ $level->name }}</label>
                        </div>

                        <div class="mb-3">
                            <label for="sport" class="form-label"><strong>Sports: </strong>
                                @foreach ($sports as $sport)
                                    <li>{{ $sport->name }}</li>
                                @endforeach
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="achievement" class="form-label"><strong>Achievement: <br></strong>{!! nl2br($athlete->achievement) !!}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Skills Section -->
                <div class="col-md-6">
                    <div class="mb-1">
                        <label for="sports" class="form-label"><strong>Skills:</strong></label>
                    </div>

                    <label for="strength" class="form-label justify-content-center">Strength</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skills->strength * 20 }}%" aria-valuenow="{{ $skills->strength * 20 }}" aria-valuemin="0" aria-valuemax="100">{{ $skills->strength * 20 }}%</div>
                    </div>

                    <label for="speed" class="form-label">Speed</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skills->speed * 20 }}%" aria-valuenow="{{ $skills->speed * 20 }}" aria-valuemin="0" aria-valuemax="100">{{ $skills->speed * 20 }}%</div>
                    </div>

                    <label for="endurance" class="form-label">Endurance</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skills->endurance * 20 }}%" aria-valuenow="{{ $skills->endurance * 20 }}" aria-valuemin="0" aria-valuemax="100">{{ $skills->endurance * 20 }}%</div>
                    </div>

                    <label for="focus" class="form-label">Focus</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skills->focus * 20 }}%" aria-valuenow="{{ $skills->focus * 20 }}" aria-valuemin="0" aria-valuemax="100">{{ $skills->focus * 20 }}%</div>
                    </div>

                    <label for="reflex" class="form-label">Reflex</label>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $skills->reflex * 20 }}%" aria-valuenow="{{ $skills->reflex * 20 }}" aria-valuemin="0" aria-valuemax="100">{{ $skills->reflex * 20 }}%</div>
                    </div>

                    @auth('staff')
                        @if (auth('staff')->user() && auth('staff')->user()->role == 'coach')
                            <a class="btn btn-primary" href="https://api.whatsapp.com/send?phone=60{{ $athlete->phone }}&text=You're scouted!" style="margin-top: 10px;" onclick="return confirmScout();">Scout</a>

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
                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;" onclick="return confirmScout();">
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

                    @auth('athlete')
                        @if (auth('athlete')->user()->id == $athlete->id)
                            <div class="mt-3">
                                <a href="{{ route('editathlete') }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('demo', ['id' => $athlete->id]) }}" class="btn btn-primary">Test</a>
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

