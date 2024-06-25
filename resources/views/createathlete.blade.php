@extends('applayout')

@section('content')

    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

    <div class="container-sm">

        <h2>Create Athlete Profile</h2>

        <!-- Centering the container and making it smaller -->
        <div>
            <!-- Centering the row horizontally -->
            @if ($errors->any())
                <div class="alert alert-danger">

                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach

                </div>
            @endif

            <form method="POST" action="{{ route('store-athlete')}}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight:</label>
                    <input type="double" step="any" id="weight" name="weight" value="{{ old('weight') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="height" class="form-label">Height:</label>
                    <input type="double" step="any" id="height" name="height" value="{{ old('height') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position:</label>
                    <input type="text" id="position" name="position" value="{{ old('position') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level:</label>
                    <select id="level" name="level" required class="form-control">
                        <option value="" disabled selected>Choose your level</option>

                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" >{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sports">Sports:</label>
                    @foreach ($sports as $sport)
                        <div>
                            <input type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}">
                            <label for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label for="achievement" class="form-label">Achievement:</label>
                    <textarea id="achievement" name="achievement" required class="form-control">{{ old('achievement') ?? '' }}</textarea>
                </div>

                <div>
                    <label for="sports">Skills:</label> <br>

                    <label for="strength">Please select the strength (1-5):</label><br>
                    <input type="range" id="strength" name="strength" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value">
                    <output>3</output>
                    <br>


                    <label for="speed">Please select the speed (1-5):</label><br>
                    <input type="range" id="speed" name="speed" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value">
                    <output>3</output>
                    <br>

                    <label for="endurance">Please select the endurance (1-5):</label><br>
                    <input type="range" id="endurance" name="endurance" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value">
                    <output>3</output>
                    <br>

                    <label for="focus">Please select the focus (1-5):</label><br>
                    <input type="range" id="focus" name="focus" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value">
                    <output>3</output>
                    <br>

                    <label for="reflex">Please select the reflex (1-5):</label><br>
                    <input type="range" id="reflex" name="reflex" min="1" max="5" value="3" oninput="this.nextElementSibling.value = this.value">
                    <output>3</output>
                    <br>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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

    </div>

@endsection
