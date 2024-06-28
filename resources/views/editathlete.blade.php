@extends('applayout')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container mt-0">
    <div class="row justify-content-center">
        <div class="col-md-10" style="padding: 5%">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: grey;">
                    <h2 class="mb-0" style="color: white">Edit Athlete Profile for {{Auth::user()->name}}</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('update-athlete' , Auth::user()->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight"><strong>Weight</strong></label>
                                    <input type="double" step="any" id="weight" name="weight" class="form-control" value="{{ Auth::user()->weight }}">
                                </div>

                                <div class="form-group">
                                    <label for="height"><strong>Height</strong></label>
                                    <input type="number" step="any" id="height" name="height" value="{{ Auth::user()->height }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="sports"><strong>Sport</strong></label><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @php
                                                $chunkedSports = $sports->chunk(4);
                                            @endphp
                                            @foreach ($chunkedSports[0] as $sport)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}"
                                                        @if (in_array($sport->id, $sportscurrent->pluck('id')->toArray())) checked @endif>
                                                    <label class="form-check-label" for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            @foreach ($chunkedSports[1] as $sport)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}"
                                                        @if (in_array($sport->id, $sportscurrent->pluck('id')->toArray())) checked @endif>
                                                    <label class="form-check-label" for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="position"><strong>Position</strong></label>
                                    <textarea id="position" name="position" class="form-control">{{ Auth::user()->position }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="achievement"><strong>Top 3 Highest Achievements</strong></label>
                                    <textarea id="achievement" name="achievement" class="form-control">{{ Auth::user()->achievement }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="level" class="form-label"><strong>Experience Level</strong></label>
                                    <select id="level" name="level" required class="form-control">
                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="image"><strong>Upload Image</strong></label>
                                    <input type="file" id="image" name="image" accept="image/*" class="form-control-file">
                                    <small class="form-text text-muted">Maximum file size: 5MB. Allowed formats: JPG, PNG.</small>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <!-- Strength -->
                                    <div class="custom-range-container" style="text-align: center;">
                                        <label for="strength"><strong>Select your strength level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="strength" name="strength" min="1" max="5" value="{{ $skillscurrent->strength }}" class="custom-range" oninput="updateSkillValue('strength', this.value)">
                                            <output for="strength">{{ $skillscurrent->strength }}</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <!-- Speed -->
                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;">
                                        <label for="speed"><strong>Select your speed level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="speed" name="speed" min="1" max="5" value="{{ $skillscurrent->speed }}" class="custom-range" oninput="updateSkillValue('speed', this.value)">
                                            <output for="speed">{{ $skillscurrent->speed }}</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <!-- Endurance -->
                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;">
                                        <label for="endurance"><strong>Select your endurance level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="endurance" name="endurance" min="1" max="5" value="{{ $skillscurrent->endurance }}" class="custom-range" oninput="updateSkillValue('endurance', this.value)">
                                            <output for="endurance">{{ $skillscurrent->endurance }}</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <!-- Focus -->
                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;">
                                        <label for="focus"><strong>Select your focus level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="focus" name="focus" min="1" max="5" value="{{ $skillscurrent->focus }}" class="custom-range" oninput="updateSkillValue('focus', this.value)">
                                            <output for="focus">{{ $skillscurrent->focus }}</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <!-- Reflex -->
                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;">
                                        <label for="reflex"><strong>Select your reflex level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="reflex" name="reflex" min="1" max="5" value="{{ $skillscurrent->reflex }}" class="custom-range" oninput="updateSkillValue('reflex', this.value)">
                                            <output for="reflex">{{ $skillscurrent->reflex }}</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSkillValue(skill, val) {
        // Update the corresponding output element
        document.querySelector(`output[for=${skill}]`).textContent = val;
    }
</script>

<!-- Tawk.to Script -->
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
<!-- End of Tawk.to Script -->

@endsection
