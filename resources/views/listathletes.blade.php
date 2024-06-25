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

    <div class="container" style="margin-top: 20px;">
        <form method="GET" action="{{ route('listathletes') }}" class="mb-4">
            <div class="row">
                <!-- Filter by Level -->
                <div class="col-md-3">
                    <label for="level">Level</label>
                    <select id="level" name="level" class="form-control">
                        <option value="">All Levels</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filter by Sport -->
                <div class="col-md-3">
                    <label for="sport">Sport</label>
                    <select id="sport" name="sport" class="form-control">
                        <option value="">All Sports</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filter by Weight Range -->
                <div class="col-md-3">
                    <label for="min_weight">Min Weight (kg)</label>
                    <input type="number" id="min_weight" name="min_weight" class="form-control" placeholder="Min Weight">
                </div>
                <div class="col-md-3">
                    <label for="max_weight">Max Weight (kg)</label>
                    <input type="number" id="max_weight" name="max_weight" class="form-control" placeholder="Max Weight">
                </div>
                <!-- Filter by Height Range -->
                <div class="col-md-3 mt-3">
                    <label for="min_height">Min Height (cm)</label>
                    <input type="number" id="min_height" name="min_height" class="form-control" placeholder="Min Height">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="max_height">Max Height (cm)</label>
                    <input type="number" id="max_height" name="max_height" class="form-control" placeholder="Max Height">
                </div>
                <!-- Filter by Skill Percentages -->
                <div class="col-md-3 mt-3">
                    <label for="min_skill">Min Skill (%)</label>
                    <input type="number" id="min_skill" name="min_skill" class="form-control" placeholder="Min Skill" min="0" max="100">
                </div>
                <div class="col-md-3 mt-3">
                    <label for="max_skill">Max Skill (%)</label>
                    <input type="number" id="max_skill" name="max_skill" class="form-control" placeholder="Max Skill" min="0" max="100">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="row">
            @foreach ($athletes as $athlete)
                @if ($athlete->status == 'Approved')
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="card">
                            @if ($athlete->image)
                                <img src="{{ asset($athlete->image) }}" class="card-img-top" alt="Athlete Image" style="height: 200px; object-fit: contain;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $athlete->name }}</h5>
                                <p class="card-text"><strong>Height:</strong> {{ $athlete->height }} cm</p>
                                <p class="card-text"><strong>Weight:</strong> {{ $athlete->weight }} kg</p>
                                <p class="card-text"><strong>Level:</strong> {{ $athlete->level->name }}</p>
                                <div class="text-center">
                                    <a href="{{ route('athleteprofile2', $athlete->id) }}" class="btn btn-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="whatsapp-chat">
        <a href="https://wa.me/+60176059047?text=You%20are%20scouted%20in%20Escout!" target="_blank">
            <img src="{{ asset ('img/whatsapp-logo.png')}}" alt="whatsapp-logo" height="50px" width="50px">
        </a>

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
