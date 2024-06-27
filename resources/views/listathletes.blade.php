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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="GET" action="{{ route('listathletes') }}" class="mb-4" style="background-color: #ffffff; padding: 20px; border-radius: 8px;">
                <div class="row">
                    <div class="col-md-4">
                        <label for="search">Search Athletes</label>
                        <input type="text" id="search" name="search" class="form-control" value="{{ Request::get('search') }}" placeholder="Enter Athlete Name">
                    </div>
                    <!-- Filter by Level -->
                    <div class="col-md-3">
                        <label for="level">Level</label>
                        <select id="level" name="level" class="form-control">
                            <option value="">All Levels</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ Request::get('level') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter by Sport -->
                    <div class="col-md-3">
                        <label for="sport">Sport</label>
                        <select id="sport" name="sport" class="form-control">
                            <option value="">All Sports</option>
                            @foreach($sports as $sport)
                                <option value="{{ $sport->id }}" {{ Request::get('sport') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Button -->
                    <div class="col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


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
                                    <a href="{{ route('demo', $athlete->id) }}" class="btn btn-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
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
