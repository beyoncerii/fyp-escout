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
                                    <input type="number" step="any" id="weight" name="weight" class="form-control" value="{{ Auth::user()->weight }}">
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

                                    <div class="form-group">
                                        <label for="stuid"><strong>Student ID</strong></label>
                                        <input type="number" step="any" id="stuid" name="stuid" class="form-control" value="{{ Auth::user()->stuid }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="strength"><strong>Programme:</strong></label>
                                        <select class="form-select" aria-label="program" name="program">
                                            <option selected value="{{ Auth::user()->program }}">{{ Auth::user()->program }}</option>
                                            <option value="C110 - Diploma in Computer Science" {{ Auth::user()->program == 'C110 - Diploma in Computer Science' ? 'hidden' : '' }}>
                                                C110 - Diploma in Computer Science</option>
                                            <option value="CS230 - Bachelor of Computer Science (Hons.)" {{ Auth::user()->program == 'CS230 - Bachelor of Computer Science (Hons.)' ? 'hidden' : '' }}>
                                                CS230 - Bachelor of Computer Science (Hons.)</option>
                                            <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking" {{ Auth::user()->program == 'CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking' ? 'hidden' : '' }}>
                                                CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                                            <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing" {{ Auth::user()->program == 'CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing' ? 'hidden' : '' }}>
                                                CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                                            <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing" {{ Auth::user()->program == 'HCS251 - Bachelor of Computer Science (Hons.) Netcentric Computing' ? 'hidden' : '' }}>
                                                CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                                            <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering" {{ Auth::user()->program == 'CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering' ? 'hidden' : '' }}>
                                                CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                                            <option value="AT110 - Diploma in Planting Industry Management" {{ Auth::user()->program == 'AT110 - Diploma in Planting Industry Management' ? 'hidden' : '' }}>
                                                AT110 - Diploma in Planting Industry Management</option>
                                            <option value="AT220 - Bachelor of Science (Hons) Plantation Technology and Management" {{ Auth::user()->program == 'AT220 - Bachelor of Science (Hons) Plantation Technology and Management' ? 'hidden' : '' }}>
                                                AT220 - Bachelor of Science (Hons) Plantation Technology and Management</option>
                                            <option value="AT222 - Bachelor of Science (Hons) Agronomy" {{ Auth::user()->program == 'AT222 - Bachelor of Science (Hons) Agronomy' ? 'hidden' : '' }}>
                                                AT222 - Bachelor of Science (Hons) Agronomy</option>
                                            <option value="AT223 - Bachelor of Science (Hons) Agribusiness" {{ Auth::user()->program == 'AT223 - Bachelor of Science (Hons) Agribusiness' ? 'hidden' : '' }}>
                                                AT223 - Bachelor of Science (Hons) Agribusiness</option>
                                            <option value="AT226 - Bachelor of Science (Hons) in Agrotechnology (Plant Biotechnology)" {{ Auth::user()->program == 'AT226 - Bachelor of Science (Hons) in Agrotechnology (Plant Biotechnology)' ? 'hidden' : '' }}>
                                                AT226 - Bachelor of Science (Hons) in Agrotechnology (Plant Biotechnology)</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semester"><strong>Semester</strong></label>
                                        <select class="form-select" aria-label="semester" name="semester" >
                                            <option selected value="{{ Auth::user()->semester }}">{{ Auth::user()->semester }}</option>
                                            <option value="1" {{ Auth::user()->semester == '1' ? 'hidden' : ''}}>1</option>
                                            <option value="2" {{ Auth::user()->semester == '2' ? 'hidden' : ''}}>2</option>
                                            <option value="3" {{ Auth::user()->semester == '3' ? 'hidden' : ''}}>3</option>
                                            <option value="4" {{ Auth::user()->semester == '4' ? 'hidden' : ''}}>4</option>
                                            <option value="5" {{ Auth::user()->semester == '5' ? 'hidden' : ''}}>5</option>
                                            <option value="6" {{ Auth::user()->semester == '6' ? 'hidden' : ''}}>6</option>
                                            <option value="7" {{ Auth::user()->semester == '7' ? 'hidden' : ''}}>7</option>
                                            <option value="8" {{ Auth::user()->semester == '8' ? 'hidden' : ''}}>8</option>
                                        </select>
                                    </div>

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
