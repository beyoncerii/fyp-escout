@extends('applayout')

@section('content')

    <link rel="stylesheet" href="{{asset('css/profile.css')}}">

    <div class="container-sm">

        <h2>Update Athlete Profile</h2>

        <div>
            @if (session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif

            <form method="POST" action="{{ route('update-athlete' , Auth::user()->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight:</label>
                    <input type="double" step="any" id="weight" name="weight" value="{{ Auth::user()->weight }}">
                </div>

                <div class="mb-3">
                    <label for="height" class="form-label">Height:</label>
                    <input type="double" step="any" id="height" name="height" value="{{ Auth::user()->height }}">
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label">Position:</label>
                    <input type="text" id="position" name="position" value="{{ Auth::user()->position }}">
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level:</label>
                    <select id="level" name="level" >
                        <option value="{{$level->id}}" >{{$level->name}}</option>

                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" >{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sports">Sports:</label>
                    @foreach ($sports as $sport)
                        <div>
                            <input type="checkbox" name="sports[]" id="sport-{{ $sport->id }}" value="{{ $sport->id }}"
                                @if (in_array($sport->id, $sportscurrent->pluck('id')->toArray())) checked @endif>
                            <label for="sport-{{ $sport->id }}">{{ $sport->name }}</label>
                        </div>
                    @endforeach
                </div>


                <div class="mb-3">
                    <label for="achievement" class="form-label">Achievement:</label>
                    <textarea id="achievement" name="achievement" >{{ Auth::user()->achievement }}</textarea>
                </div>

                <div>
                    <label for="sports">Skills:</label> <br>

                    <label for="strength">Please select the strength (1-5):</label><br>
                    <input type="range" id="strength" name="strength" min="1" max="5" value="{{$skillscurrent->strength}}" oninput="this.nextElementSibling.value = this.value">
                    <output>{{$skillscurrent->strength}}</output>
                    <br>


                    <label for="speed">Please select the speed (1-5):</label><br>
                    <input type="range" id="speed" name="speed" min="1" max="5" value="{{$skillscurrent->speed}}" oninput="this.nextElementSibling.value = this.value">
                    <output>{{$skillscurrent->speed}}</output>
                    <br>

                    <label for="endurance">Please select the endurance (1-5):</label><br>
                    <input type="range" id="endurance" name="endurance" min="1" max="5" value="{{$skillscurrent->endurance}}" oninput="this.nextElementSibling.value = this.value">
                    <output>{{$skillscurrent->endurance}}</output>
                    <br>

                    <label for="focus">Please select the focus (1-5):</label><br>
                    <input type="range" id="focus" name="focus" min="1" max="5" value="{{$skillscurrent->focus}}" oninput="this.nextElementSibling.value = this.value">
                    <output>{{$skillscurrent->focus}}</output>
                    <br>

                    <label for="reflex">Please select the reflex (1-5):</label><br>
                    <input type="range" id="reflex" name="reflex" min="1" max="5" value="{{$skillscurrent->reflex}}" oninput="this.nextElementSibling.value = this.value">
                    <output>{{$skillscurrent->reflex}}</output>
                    <br>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>

            </form>
        </div>
    </div>

@endsection
