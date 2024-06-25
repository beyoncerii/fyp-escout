

@extends('applayout')

@section('content')

<title>Register EScout</title>


<link rel="stylesheet" href="{{asset('css/register.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container-sm">
<div class="registerform">
    <h1 class="title">Register</h1>

    <form action="{{ route('register-store')}}" method="post">
    @csrf

    @if ( $errors -> any())
    <p class="alert alert-danger">Please check your input</p>
    @endif

    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
        name="name" value="{{old('name')}}"
        placeholder="Enter your full name" required>

        @error('name')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
        name="phone" value="{{old('phone')}}"
        placeholder="Enter your phone number" required>

        @error('phone')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
        name="email" value="{{old('email')}}"
        placeholder="Enter your email address" required>

        @error('email')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror"
        name="password" value="{{old('password')}}"
        placeholder="Enter your password" required>

        @error('password')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{old('password_confirmation')}}"
        placeholder="Enter your password" required>

        @error('password_confirmation')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

    <div style="margin-top: 2%">
        <label for="role">Register as: </label>
        <select name="role" id="role" required>
            <option value="">Select Role</option>
            <option value="athlete" {{ old('role') == 'athlete' ? 'selected' : '' }}>Athlete</option>
            <option value="coach" {{ old('role') == 'coach' ? 'selected' : '' }}>Coach</option>
        </select>

        @error('role')
            <span>{{ $message }}</span>
        @enderror
    </div>


    <div class="button">

        <button type="submit" class="btn btn-primary col-lg-12 col-12 mt-2 mb-3">Register</button>
        <!-- your form fields here -->
        <a class="btn btn-primary col-lg-12 col-12 mt-2 mb-2" href="{{url('login')}}" style="text-decoration: none; color:white">Back to Login</a>
</div>


    </form>
</div>
</div>
@endsection
