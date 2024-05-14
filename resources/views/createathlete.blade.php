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
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                {{-- <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="form-control">
                </div> --}}
                <div class="mb-3">
                    <label for="level" class="form-label">Level:</label>
                    <select id="level" name="level" required class="form-control">
                        <option value="" disabled selected>Choose your level</option>

                        @foreach($levels as $level)
                        <option value="{{ $level->id }}" >{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
