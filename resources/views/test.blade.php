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
                    <h2 class="mb-0" style="color: white">Create Athlete Profile </h2>
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

                    <form method="POST" action="{{ route('store-athlete')}}" enctype="multipart/form-data" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight"><strong>Weight</strong></label>
                                    <input type="number" step="any" id="weight" name="weight"  class="form-control"  value="{{ old('weight') }}" >
                                </div>

                                <div class="form-group">
                                    <label for="height"><strong>Height</strong></label>
                                    <input type="number" step="any" id="height" name="height" value="{{ old('height') }}"   class="form-control">
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
                                                    <input class="form-check-input" type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}">
                                                    <label class="form-check-label" for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            @foreach ($chunkedSports[1] as $sport)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}">
                                                    <label class="form-check-label" for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="position"><strong>Position</strong></label>
                                    <textarea id="position" name="position"  class="form-control" placeholder="Enter your positions">{{ old('position') ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="achievement"><strong>Top 3 Highest Achievements</strong></label>
                                    <textarea id="achievement" name="achievement" class="form-control" placeholder="Enter your top 3 highest achievements">{{ old('achievement') ?? '' }}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="level" class="form-label"><strong>Experience Level</strong></label>
                                    <select id="level" name="level" required class="form-control">
                                        <option value="" disabled selected>Choose your level</option>

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
                                        <input type="number" id="stuid" name="stuid" class="form-control" placeholder="Enter your stuid"></input>
                                    </div>

                                    <div class="mb-3">
                                        <label for="strength"><strong>Programme:</strong></label>
                                        <select class="form-select" aria-label="program" name="program" >
                                            <option selected >Choose your programme</option>

                                            <option value="C110 - Diploma in Computer Science">
                                                C110 - Diploma in Computer Science</option>
                                            <option value="CS230 - Bachelor of Computer Science (Hons.)">
                                                CS230 - Bachelor of Computer Science (Hons.)</option>
                                            <option value="CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking">
                                                CS255 - Bachelor of Computer Science (Hons.) Data Communication and Networking</option>
                                            <option value="CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing">
                                                CS253 - Bachelor of Computer Science (Hons.) Multimedia Computing</option>
                                            <option value="CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing">
                                                CS251 - Bachelor of Computer Science (Hons.) Netcentric Computing</option>
                                            <option value="CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering">
                                                CS266 - Bachelor of Information Technology (Hons.) Information Systems Engineering</option>
                                            <option value="AT110 - Diploma in Planting Industry Management">
                                                AT110 - Diploma in Planting Industry Management</option>
                                            <option value="AT220 - Bachelor of Science (Hons) Plantation Technology and Management">
                                                AT220 - Bachelor of Science (Hons) Plantation Technology and Management</option>
                                            <option value="AT222 - Bachelor of Science (Hons) Agronomy">
                                                AT222 - Bachelor of Science (Hons) Agronomy</option>
                                            <option value="AT223 - Bachelor of Science (Hons) Agribusiness">
                                                AT223 - Bachelor of Science (Hons) Agribusiness</option>
                                            <option value="AT226 - Bachelor of Science (Hons) in Agrotechnology (Plant Biotechnology)">
                                                AT226 - Bachelor of Science (Hons) in Agrotechnology (Plant Biotechnology)</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semester"><strong>Semester</strong></label>
                                        <select class="form-select" aria-label="semester" name="semester" >
                                            <option selected >Select current semester</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>

                                    <div class="custom-range-container" style="text-align: center">
                                        <label for="strength"><strong>Select your strength level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="strength" name="strength" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="custom-range" oninput="updateSkillValue('strength', this.value)">
                                            <output for="strength">3</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>



                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;">
                                        <label for="speed"><strong>Select your speed level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="speed" name="speed" min="1" max="5" value=3 oninput="this.nextElementSibling.value = this.value" class="custom-range" oninput="updateSkillValue('strength', this.value)">
                                            <output for="speed">3</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;"> <!-- Adjust margin-top for spacing -->
                                        <label for="endurance"><strong>Select your endurance level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="endurance" name="endurance" min="1" max="5" oninput="this.nextElementSibling.value = this.value" class="custom-range" oninput="updateSkillValue('endurance', this.value)">
                                            <output for="endurance">3</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;"> <!-- Adjust margin-top for spacing -->
                                        <label for="focus"><strong>Select your focus level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="focus" name="focus" min="1" max="5" oninput="this.nextElementSibling.value = this.value" class="custom-range" oninput="updateSkillValue('focus', this.value)">
                                            <output for="focus">3</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <div class="custom-range-container" style="text-align: center; margin-top: 40px;"> <!-- Adjust margin-top for spacing -->
                                        <label for="reflex"><strong>Select your reflex level:</strong></label>
                                        <div class="range-labels">
                                            <span class="weak">Weak</span>
                                            <input type="range" id="reflex" name="reflex" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value" class="custom-range" oninput="updateSkillValue('reflex', this.value)">
                                            <output for="reflex">3</output>
                                            <span class="strong">Strong</span>
                                        </div>
                                    </div>

                                    <script>
                                        function updateSkillValue(skill, val) {
                                            document.querySelector(`output[for=${skill}]`).textContent = val;
                                        }
                                    </script>


                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create Profile</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script>
    function updateStrengthValue(val) {
        document.getElementById('strength-value').innerHTML = val;
    }

    function updateSpeedValue(val) {
        document.getElementById('speed-value').innerHTML = val;
    }

    function updateEnduranceValue(val) {
        document.getElementById('endurance-value').innerHTML = val;
    }

    function updateFocusValue(val) {
        document.getElementById('focus-value').innerHTML = val;
    }

    function updateReflexValue(val) {
        document.getElementById('reflex-value').innerHTML = val;
    }
</script>

@endsection
